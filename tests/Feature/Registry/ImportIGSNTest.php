<?php


namespace Tests\Feature\Registry;


use App\Registry\ImportManager;
use App\Registry\Models\DataSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportIGSNTest extends TestCase
{
    use RefreshDatabase;

    // TODO make this test work
    function it_can_insert_IGSN()
    {
        $igsn = resource_path('tests/igsn/XXAB00000.xml');
        $dataSource = factory(DataSource::class)->create();

        $importer = new ImportManager();
        $importer->import([
            'data_source_id' => $dataSource->id,
            'payload' => [
                'schema' => 'igsn',
                'data' => [
                    'type' => 'local',
                    'path' => $igsn
                ]
            ]
        ]);

        // 1 record in the data source
        $this->assertEquals(1, $dataSource->records->count());
        $record = $dataSource->records->first();
        $this->assertEquals('igsn', $record->current->schema);
    }
}
