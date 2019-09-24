<?php

namespace App\Jobs;

use App\Events\RecordMetadataUpdated;
use App\Registry\Models\Record;
use App\Registry\SchemaManager;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessRecordMetadata implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $record;

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

        // check if record meta is up to date
        if ($record->meta && $record->meta['timestamp']) {
            $metaUpdatedAt = Carbon::parse($record->meta['timestamp']);
            if ($record->updated_at->lessThanOrEqualTo($metaUpdatedAt)) {
                return;
            }
        }

        $provider = SchemaManager::provider($record->current->schema);
        $metadata = call_user_func([$provider, 'extract'], $record->current->data);
        $metadata['timestamp'] = Carbon::now();
        // TODO handle exceptions

        // set metadata to the record table
        $record->meta = $metadata;
        $title = array_key_exists('title', $metadata['core'])
            ? $metadata['core']['title']
            : 'Untitled';
        $record->title = $title;
        $record->save();

        event(new RecordMetadataUpdated($record));
    }
}
