<?php


namespace Tests\Unit\Registry\ContentProvider\RIFCS;


use App\Registry\ContentProvider\RIFCS\RIFCSContentProvider;
use App\Registry\ContentProvider\RIFCS\Metadata\RIFCSCoreProvider;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RIFCSCoreProviderTest extends TestCase
{
    /** @test */
    function it_extracts_core_metadata()
    {
        $provider = new RIFCSCoreProvider(Storage::disk('tests')->get('rifcs/collection_all_elements.xml'));
        $metadata = $provider->handle();

        $this->assertArrayHasKey('key', $metadata);
        $this->assertArrayHasKey('type', $metadata);
        $this->assertArrayHasKey('class', $metadata);
        $this->assertArrayHasKey('group', $metadata);
    }
}
