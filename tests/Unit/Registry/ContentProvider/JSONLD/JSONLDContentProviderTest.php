<?php


namespace Tests\Unit\Registry\ContentProvider\JSONLD;


use App\Registry\ContentProvider\JSONLD\JSONLDContentProvider;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JSONLDContentProviderTest extends TestCase
{
    /** @test */
    function it_extracts_information_from_jsonld_document()
    {
        $jsonld = Storage::disk('tests')->get('jsonld/rda-754374.json');

        $provider = new JSONLDContentProvider();
        $metadata = $provider->extract($jsonld);

        $providers = config('registry.schemas.json-ld.metadata');
        $this->assertEquals(array_keys($providers), array_keys($metadata));
    }
}
