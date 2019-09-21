<?php

namespace App;

class ImportManager
{
    public function import(DataSource $dataSource, $request)
    {
        // $this->validateImportRequest($request);

        // TODO check data source existence

        $schema = Schema::where('schema_id', $request['payload']['schema_id'])->get()->first();
        // TODO check schema existence

        $payload = $request['payload']['data'];
        // TODO check payload existence

        // extract identification from payload to update existing records

        // create new record
        $this->addRecord($dataSource, $schema, $payload);

        // or update existing record
    }

    public function addRecord(DataSource $dataSource, Schema $schema, $payload)
    {
        $record = Record::create([
            'title' => 'untitled',
            'data_source_id' => $dataSource->id
        ]);

        $version = Version::create([
            'schema_id' => $schema->schema_id,
            'record_id' => $record->id,
            'status' => 'CURRENT',
            'data' => $payload
        ]);
    }

    public function updateRecord(Record $record, Schema $schema, $payload)
    {
        $record->versions()->where('schema_id', $schema->schema_id)->update([
            'status' => 'SUPERCEDED'
        ]);

        Version::create([
            'schema_id' => $schema->schema_id,
            'record_id' => $record->id,
            'status' => 'CURRENT',
            'data' => $payload
        ]);
    }
}
