<?php

namespace Tests\Feature\Registry;

use App\Registry\ImportManager;
use App\Registry\Models\DataSource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImportJSONLDTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_can_import_jsonld()
    {
        $json = resource_path('tests/jsonld/rda-754374.json');
        $dataSource = create(DataSource::class);

        $importer = new ImportManager();
        $importer->import([
            'data_source_id' => $dataSource->id,
            'payload' => [
                'schema' => 'json-ld',
                'data' => [
                    'type' => 'local',
                    'path' => $json
                ]
            ]
        ]);

        // 1 record in the data source
        $this->assertEquals(1, $dataSource->records->count());
        $record = $dataSource->records->first();
        $this->assertEquals('json-ld', $record->current->schema);
    }

    // TODO test extract basic information from json-ld
}
