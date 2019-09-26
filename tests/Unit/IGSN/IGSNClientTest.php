<?php

namespace Tests\Unit\IGSN;

use App\IGSN\Models\IGSNClient;
use App\IGSN\Models\IGSNPrefix;
use App\Registry\Models\DataSource;
use App\Registry\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IGSNClientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_igsn_client_belongs_to_a_real_user()
    {
        $client = factory(IGSNClient::class)->create();
        $this->assertInstanceOf(User::class, $client->user);
    }

    /** @test */
    function an_igsn_client_have_access_to_a_datasource()
    {
        $client = factory(IGSNClient::class)->create();
        $this->assertInstanceOf(DataSource::class, $client->datasource);
    }

    /** @test */
    function an_igsn_client_can_have_multiple_prefix()
    {
        $client = factory(IGSNClient::class)->create();
        $client->prefixes()->saveMany([
            factory(IGSNPrefix::class)->create(),
            factory(IGSNPrefix::class)->create(),
        ]);

        $this->assertCount(2, $client->fresh()->prefixes);
    }
}
