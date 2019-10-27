<?php

namespace Tests\Feature;

use App\Jobs\ImportJob;
use App\Registry\Models\DataSource;
use App\Registry\Models\Import;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportJobTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_job_should_run_and_completed()
    {
        ImportJob::dispatchNow($import = factory(Import::class)->create());
        $this->assertEquals(Import::$STATUS_COMPLETED, $import->fresh()->status);
    }

    /** @test */
    function a_job_when_run_will_populate_subtasks()
    {
        $import = factory(Import::class)->create([
            'params' => [
                'src' => [
                    'schema' => 'rifcs',
                    'type' => 'plain',
                    'content' => Storage::disk('tests')->get('jsonld/rda-754374.json')
                ],
                'dest' => [
                    'data_source_id' => factory(DataSource::class)->create()->id
                ]
            ]
        ]);
        ImportJob::dispatchNow($import);

        // subtasks are filled
        $this->assertIsArray($import->fresh()->info['subtasks']);
    }

    // TODO move to functional test
    /** @test */
    function an_import_will_insert_1_record()
    {
        // setup
        $dataSource = factory(DataSource::class)->create();
        $import = factory(Import::class)->create([
            'params' => [
                'src' => [
                    'schema' => 'rifcs',
                    'type' => 'plain',
                    'content' => Storage::disk('tests')->get('rifcs/rda-754374.xml')
                ],
                'dest' => [
                    'data_source_id' => $dataSource->id
                ]
            ]
        ]);

        // act
        ImportJob::dispatchNow($import);

        // there is now 1 record
        $this->assertCount(1, $dataSource->fresh()->records);
    }

    // TODO move to ingestsubtask
    /** @test */
    function an_import_of_the_same_payload_will_leave_record_unchanged()
    {
        $dataSource = factory(DataSource::class)->create();
        $import = factory(Import::class)->create([
            'params' => [
                'src' => [
                    'schema' => 'rifcs',
                    'type' => 'plain',
                    'content' => Storage::disk('tests')->get('rifcs/rda-754374.xml')
                ],
                'dest' => [
                    'data_source_id' => $dataSource->id
                ]
            ]
        ]);

        ImportJob::dispatchNow($import);

        // there is now 1 record
        $this->assertCount(1, $dataSource->fresh()->records);

        // import again
        ImportJob::dispatchNow($import);

        // still 1 record, because the record is unchanged
        $this->assertCount(1, $dataSource->fresh()->records);
    }
}
