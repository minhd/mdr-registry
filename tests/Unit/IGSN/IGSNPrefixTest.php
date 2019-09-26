<?php

namespace Tests\Unit\IGSN;

use App\IGSN\Models\IGSNClient;
use App\IGSN\Models\IGSNPrefix;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IGSNPrefixTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_prefix_can_have_multiple_client()
    {
        $client = factory(IGSNClient::class)->create();
        $client2 = factory(IGSNClient::class)->create();

        $prefix = factory(IGSNPrefix::class)->create();

        $client->prefixes()->save($prefix);
        $client2->prefixes()->save($prefix);

        $this->assertCount(2, $prefix->clients);
    }
}
