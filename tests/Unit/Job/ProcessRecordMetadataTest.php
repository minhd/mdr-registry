<?php


namespace Tests\Unit\Job;


use App\Events\RecordMetadataUpdated;
use App\Jobs\ProcessRecordMetadata;
use App\Jobs\SyncRecord;
use App\Registry\Models\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProcessRecordMetadataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_should_process_record_correctly()
    {
        $version = factory(Version::class)->create([
            'status' => config('registry.status.current'),
            'schema' => 'json-ld',
            'data' => Storage::disk('tests')->get('jsonld/rda-754374.json')
        ]);

        dispatch(new ProcessRecordMetadata($version->record));

        $record = $version->fresh()->record;

        // it sets the meta
        $this->assertNotEmpty($record->meta);
        $this->assertEquals("Aboveground net primary productivity and photosynthesis for EucFACE from 2013 to 2015", $record->title);
    }

    /** @test */
    function it_shouldnt_reprocess_record_that_havent_been_updated()
    {
        Event::fake();

        $version = factory(Version::class)->create([
            'status' => config('registry.status.current'),
            'schema' => 'json-ld',
            'data' => Storage::disk('tests')->get('jsonld/rda-754374.json')
        ]);
        dispatch(new ProcessRecordMetadata($version->record));

        // process again
        dispatch(new ProcessRecordMetadata($version->record));

        // only onced the record metadata was updated
        Event::assertDispatched(RecordMetadataUpdated::class, 1);
    }
}
