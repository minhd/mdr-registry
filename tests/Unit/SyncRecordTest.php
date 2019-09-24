<?php


namespace Tests\Unit;


use App\Jobs\SyncRecord;
use App\Registry\ImportManager;
use App\Registry\Models\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SyncRecordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_should_sync_jsonld_record()
    {
        $version = factory(Version::class)->create([
            'status' => 'CURRENT',
            'schema' => 'json-ld',
            'data' => Storage::disk('tests')->get('jsonld/rda-754374.json')
        ]);

        dispatch(new SyncRecord($version->record));

        $record = $version->fresh()->record;

        // it sets the meta
        $this->assertNotEmpty($record->meta);

        // it sets the title
        $this->assertEquals("Aboveground net primary productivity and photosynthesis for EucFACE from 2013 to 2015", $record->title);
    }

    /** @test */
    function it_syncs_rifcs_records()
    {
        $version = factory(Version::class)->create([
            'status' => 'CURRENT',
            'schema' => 'rifcs',
            'data' => Storage::disk('tests')->get('rifcs/collection_all_elements.xml')
        ]);

        dispatch(new SyncRecord($version->record));

        // it sets the meta
        $this->assertNotEmpty($version->record->fresh()->meta);

        // TODO it sets the title
        // TODO it sets identifiers
    }
}
