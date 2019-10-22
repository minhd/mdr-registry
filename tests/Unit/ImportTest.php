<?php

namespace Tests\Unit;

use App\Registry\Models\DataSource;
use App\Registry\Models\Import;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_import_belongs_to_a_data_source()
    {
        $import = factory(Import::class)->create();
        $this->assertInstanceOf(DataSource::class, $import->datasource);
    }
    /** @test */
    function an_import_has_params()
    {
        $import = factory(Import::class)->create([
            'params' => [
                'src' => [
                    'type' => 'plain',
                    'content' => 'stuff'
                ]
            ],
            'info' => [
                'subtasks' => []
            ]
        ]);
        $this->assertIsArray($import->params);
        $this->assertIsArray($import->info);
    }

    // an import has subtasks defined in the data

    // an import has subtasks defined by workflow
}
