<?php

namespace Tests\Feature;

use App\Jobs\ImportJob;
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
                ]
            ]
        ]);
        ImportJob::dispatchNow($import);

        // subtasks are filled
        $this->assertIsArray($import->fresh()->info['subtasks']);
    }
}
