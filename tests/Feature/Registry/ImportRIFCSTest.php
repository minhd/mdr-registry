<?php


namespace Tests\Feature\Registry;


use App\Registry\ImportManager;
use App\Registry\Models\DataSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportRIFCSTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_can_import_rifcs()
    {
        $rifcs = resource_path('tests/rifcs/collection_all_elements.xml');
        $dataSource = create(DataSource::class);

        $importer = new ImportManager();
        $importer->import([
            'data_source_id' => $dataSource->id,
            'payload' => [
                'schema' => 'rifcs',
                'data' => [
                    'type' => 'local',
                    'path' => $rifcs
                ]
            ]
        ]);

        // 1 record in the data source
        $this->assertEquals(1, $dataSource->records->count());
        $record = $dataSource->records->first();
        $this->assertEquals('rifcs', $record->current->schema);
    }

    // TODO test extract basic information from rifcs
}
