<?php

namespace App\Jobs;

use App\Registry\Models\Import;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $import;

    /**
     * Create a new job instance.
     *
     * @param Import $import
     */
    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Running import: {$this->import->id}");
        $this->import->setStatus(Import::$STATUS_RUNNING);

        // TODO determine subtasks based on type, schema and workflow
        $subtasks = $this->determineSubtasks($this->import->params);
        $this->import->saveTaskData('subtasks', $subtasks);

        // TODO foreach subtasks, do the thing

        $this->import->setStatus(Import::$STATUS_COMPLETED);
        Log::info("Finished import: {$this->import->id}");
    }

    public function determineSubtasks($params)
    {
        $subtasks = [];

//        $type = $params['src']['type'];
//        $schema = $params['src']['schema'];
//
//        $metadata = config("registry.schemas.$schema.metadata");
//
//        if ($type === 'plain') {
//            $subtasks = [];
//        }

        return $subtasks;
    }
}
