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

    /** @test */
    function an_igsn_client_has_one_active_prefix()
    {
        $client = factory(IGSNClient::class)->create();
        $first = factory(IGSNPrefix::class)->create();
        $second = factory(IGSNPrefix::class)->create();
        $client->prefixes()->saveMany([
            $first,
            $second,
        ]);
        $client->setActivePrefix($first);
        $this->assertEquals($first->prefix, $client->fresh()->active_prefix->prefix);
        $this->assertDatabaseHas('igsn_client_prefix', [
            'client_id' => $client->id,
            'prefix_id' => $first->id,
            'active' => true
        ]);
        $this->assertDatabaseHas('igsn_client_prefix', [
            'client_id' => $client->id,
            'prefix_id' => $second->id,
            'active' => false
        ]);

        // the other way (toggle)
        $client->setActivePrefix($second);
        $this->assertEquals($second->prefix, $client->fresh()->active_prefix->prefix);
        $this->assertDatabaseHas('igsn_client_prefix', [
            'client_id' => $client->id,
            'prefix_id' => $second->id,
            'active' => true
        ]);
        $this->assertDatabaseHas('igsn_client_prefix', [
            'client_id' => $client->id,
            'prefix_id' => $first->id,
            'active' => false
        ]);
    }
}
