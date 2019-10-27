<?php

namespace App\Jobs;

use App\Registry\Models\DataSource;
use App\Registry\Models\Import;
use App\Registry\Models\Record;
use App\Registry\Models\Version;
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
        $subtasks = $this->determineSubtasks();
        $this->import->saveTaskData('subtasks', $subtasks);

        $this->ingest();

        // TODO foreach subtasks, do the thing

        $this->import->setStatus(Import::$STATUS_COMPLETED);
        Log::info("Finished import: {$this->import->id}");
    }

    private function ingest()
    {
        $dataSource = DataSource::find($this->import->params['dest']['data_source_id']);
        $schema = $this->import->params['src']['schema'];
        $payload = $this->import->params['src']['content'];
        $hash = Version::hash($payload);

        // if there's already a record with the exact same key, update it
        // get primary identifier
        // if there's already a record with the same primary identifier, check if the version is updated

        // if there's already a version with the exact same schema and payload hash, skip it
        $existing = Version::where('schema', $schema)->where('hash', $hash)->first();
        if ($existing) {
            Log::info("Unchanged");
            return;
        }

        $record = Record::create([
            'title' => 'untitled',
            'data_source_id' => $dataSource->id
        ]);
        $record->versions()->create([
            'schema' => $schema,
            'record_id' => $record->id,
            'status' => 'CURRENT',
            'data' => $payload
        ]);
        Log::info("Created Record: {$record->id}");

        // TODO mark ingest as completed
    }

    public function determineSubtasks()
    {
        $subtasks = [];
        $params = $this->import->params;

        $type = $params['src']['type'];
        $schema = $params['src']['schema'];

//        $metadata = config("registry.schemas.$schema.metadata");
//
//        if ($type === 'plain') {
//            $subtasks = [];
//        }

        return $subtasks;
    }
}
