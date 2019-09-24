<?php

namespace Tests\Unit\Registry\ContentProvider\RIFCS;

use App\Registry\ContentProvider\RIFCS\RIFCSContentProvider;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RIFCSContentProviderTest extends TestCase
{
    /** @test */
    function it_extracts_metadata_from_rifcs_correctly()
    {
        $rifcs = Storage::disk('tests')->get('rifcs/collection_all_elements.xml');

        $provider = new RIFCSContentProvider();
        $metadata = $provider->extract($rifcs);

        $providers = config('registry.schemas.rifcs.metadata');
        $this->assertEquals(array_keys($providers), array_keys($metadata));

        // random element checking
        $this->assertEquals("AUTESTING_ALL_ELEMENTS_TEST", $metadata['core']['key']);
        $this->assertContains("nla.AUTCollection1", collect($metadata['identifiers'])->pluck('value'));
    }
}
