<?php

namespace App\Jobs;

use App\Registry\Models\Record;
use App\Registry\SchemaManager;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SyncRecord implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $record;

    /**
     * Create a new job instance.
     *
     * @param Record $record
     */
    public function __construct(Record $record)
    {
        $this->record = $record;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $record = $this->record;

        $provider = SchemaManager::provider($record->current->schema);
        $metadata = call_user_func([$provider, 'extract'], $record->current->data);
        // TODO handle exceptions

        // set metadata to the record table
        $record->meta = $metadata;
        $title = array_key_exists('title', $metadata['core'])
            ? $metadata['core']['title']
            : 'Untitled';
        $record->title = $title;
        $record->save();

        // TODO identifiers
        // TODO Index
    }
}
