<?php


namespace Tests\Unit\Registry\ContentProvider\JSONLD\Metadata;


use App\Registry\ContentProvider\JSONLD\Metadata\JSONLDCoreProvider;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JSONLDCoreProviderTest extends TestCase
{
    /** @test */
    function it_should_obtain_core_metadata_for_jsonld()
    {
        $provider = new JSONLDCoreProvider(Storage::disk('tests')->get('jsonld/rda-754374.json'));
        $metadata = $provider->handle();

        $this->assertArrayHasKey('title', $metadata);
        $this->assertArrayHasKey('type', $metadata);
        $this->assertArrayHasKey('url', $metadata);
    }
}
