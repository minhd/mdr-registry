<?php

namespace Tests\Unit\Registry;

use App\Registry\ContentProvider\ContentProvider;
use App\Registry\ContentProvider\RIFCS\RIFCSContentProvider;
use App\Registry\SchemaManager;
use Tests\TestCase;

class SchemaManagerTest extends TestCase
{
    /** @test */
    function it_should_return_the_correct_provider()
    {
        $provider = SchemaManager::provider('rifcs');

        $this->assertInstanceOf(RIFCSContentProvider::class, $provider);
        $this->assertInstanceOf(ContentProvider::class, $provider);
    }
}
