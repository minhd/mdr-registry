<?php


namespace Tests\Unit\Registry\ContentProvider\RIFCS;


use App\Registry\ContentProvider\RIFCS\Metadata\RIFCSCoreProvider;
use App\Registry\ContentProvider\RIFCS\Metadata\RIFCSIdentifierProvider;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RIFCSIdentifierProviderTest extends TestCase
{
    /** @test */
    function it_should_get_identifiers()
    {
        $provider = new RIFCSIdentifierProvider(Storage::disk('tests')->get('rifcs/collection_all_elements.xml'));
        $identifiers = $provider->handle();

        // it has 2 identifiers
        $this->assertCount(2, $identifiers);

        // check the types

        // check the values
    }
}
