<?php

namespace App\Registry;

use App\Events\RecordCreated;
use App\Events\RecordUpdated;
use App\Jobs\ProcessRecordMetadata;
use App\Jobs\SyncRecord;
use App\Registry\Models\DataSource;
use App\Registry\Models\Record;
use App\Registry\Models\Version;
use Exception;

class ImportManager
{
    /**
     * @param $request
     * @throws Exception
     */
    public function import($request)
    {
        // $this->validateImportRequest($request);
        $dataSource = DataSource::find($request['data_source_id']);
        if (!$dataSource) {
            throw new Exception("DataSource not found");
        }

        // TODO validate data source id
        // TODO validate schema
        // TODO validate payload

        $schema = $request['payload']['schema'];
        if (!SchemaManager::supports($schema)) {
            throw new Exception("Schema $schema is not supported");
        }

        // determine payload type and data
        $payload = $request['payload']['data'];
        $data = null;
        if ($payload['type'] === 'local') {
            $data = file_get_contents($payload['path']);
        } elseif ($payload['type'] === 'plain') {
            $data = $payload['content'];
        }
        if (!$data) {
            throw new Exception("Can't determine payload {json_encode($payload}");
        }

        // extract identification from payload to update existing records

        // create new record
        $record = $this->addRecord($dataSource, $schema, $data);

        // or update existing record

        dispatch(new ProcessRecordMetadata($record));
    }

    public function addRecord(DataSource $dataSource, $schema, $payload)
    {
        $record = Record::create([
            'title' => 'untitled',
            'data_source_id' => $dataSource->id
        ]);

        $version = Version::create([
            'schema' => $schema,
            'record_id' => $record->id,
            'status' => 'CURRENT',
            'data' => $payload
        ]);

        event(new RecordCreated($record, $version));
        return $record;
    }

    public function updateRecord(Record $record, $schema, $payload)
    {
        $record->versions()->where('schema', $schema)->update([
            'status' => 'SUPERCEDED'
        ]);

        Version::create([
            'schema' => $schema,
            'record_id' => $record->id,
            'status' => 'CURRENT',
            'data' => $payload
        ]);

        event(new RecordUpdated($record));
    }
}
