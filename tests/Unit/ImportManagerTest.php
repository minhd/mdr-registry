<?php

namespace Tests\Unit;

use App\Registry\ImportManager;
use App\Registry\Models\DataSource;
use App\Registry\Models\Record;
use App\Registry\Models\Schema;
use App\Registry\Models\Version;
use Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportManagerTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     * @throws Exception
     */
    function it_can_import_a_payload_into_a_datasource()
    {
        $dataSource = create(DataSource::class);

        $manager = new ImportManager();

        $manager->import([
            'data_source_id' => $dataSource->id,
            'payload' => [
                'schema' => "rifcs",
                'data' => [
                    'type' => 'plain',
                    'content' => 'some content'
                ]
            ]
        ]);

        // there is now a record in the data source with the current version set to some data
        $this->assertCount(1, $records = Record::where('data_source_id', $dataSource->id)->get());

        // that record has a version
        $record = $records->first();
        $this->assertCount(1, $record->versions);

        // that version is current and some data
    }

    /** @test */
    function it_can_add_a_record_to_a_datasource()
    {
        $dataSource = create(DataSource::class);

        $manager = new ImportManager();
        $manager->addRecord($dataSource, 'rifcs', 'some data');

        $this->assertCount(1, $records = Record::where('data_source_id', $dataSource->id)->get());
        $this->assertCount(1, $records->first()->versions);
    }

    /** @test */
    function it_can_update_existing_record()
    {
        $version = create(Version::class);
        $record = $version->record;
        $schema = $version->schema;
        $dataSource = $record->datasource;

        $manager = new ImportManager();
        $manager->updateRecord($record, $schema, 'some other data');

        $this->assertCount(1, $records = Record::where('data_source_id', $dataSource->id)->get());
        $this->assertCount(2, $records->first()->versions);
    }
}
