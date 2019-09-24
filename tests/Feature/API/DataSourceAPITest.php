<?php

namespace Tests\Feature\API;

use App\Registry\Models\DataSource;
use App\Registry\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataSourceAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function data_source_api_is_protected()
    {
        $this->getJson(route('datasources.index'))->assertStatus(401);

        signIn();
        $this->getJson(route('datasources.index'))->assertStatus(200);
    }

    /** @test */
    function blocks_unathorised_access()
    {
        $this->postJson(route('datasources.store'), [])
            ->assertStatus(401)->assertSee('Unauthenticated');
        $this->putJson(route('datasources.update', ['datasource' => 1]), [])
            ->assertStatus(401)->assertSee('Unauthenticated');
        $this->deleteJson(route('datasources.destroy', ['datasource' => 1]), [])
            ->assertStatus(401)->assertSee('Unauthenticated');
    }

    /** @test */
    function it_shows_all_datasources()
    {
        signIn($user = create(User::class));
        create(DataSource::class, ['user_id' => $user->id], 10);

        $this->getJson(route('datasources.index'))
            ->assertStatus(200)
            ->assertJsonCount(10);
    }

    /** @test */
    function only_datasource_owned_can_be_listed()
    {
        $user = create(User::class);
        $dataSource1 = create(DataSource::class, ['user_id' => $user->id]);
        $anotherUser = create(User::class);
        $dataSource2 = create(DataSource::class, ['user_id' => $anotherUser->id]);
        signIn($user);

        $this->getJson(route('datasources.index'))
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertSee($dataSource1->title)
            ->assertDontSee($dataSource2->title);
    }

    /** @test */
    function it_shows_a_single_datasource()
    {
        $user = create(User::class);
        $dataSource = create(DataSource::class, ['user_id' => $user->id]);
        signIn($user);

        $this->getJson(route('datasources.show', ['datasource' => $dataSource->id]))
            ->assertStatus(200)
            ->assertSee($dataSource->id);
    }

    /** @test */
    function it_creates_datasource()
    {
        signIn();
        $result = $this->postJson(route('datasources.store'), [
            'title' => 'A sample data source'
        ]);
        $result->assertStatus(201);
        $result->assertSee("A sample data source");
    }

    /** @test */
    function it_validates_datasource_creation()
    {
        signIn();
        $result = $this->postJson(route('datasources.store'), []);
        $result->assertStatus(422);
        $result->assertSee("title");
        $result->assertSee("required");
    }

    /** @test */
    function it_update_datasource()
    {
        $dataSource = create(DataSource::class);
        signIn($dataSource->owner);
        $result = $this->putJson(route('datasources.update', ['datasource' => $dataSource->id]), [
            'title' => 'title changed'
        ]);
        $result->assertStatus(202);
        $result->assertSee('title changed');
    }

    /** @test */
    function it_disallow_updating_datasource_you_dont_own()
    {
        $dataSource = create(DataSource::class);
        signIn($notOwner = create(User::class));

        $result = $this->putJson(route('datasources.update', ['datasource' => $dataSource->id]), [
            'title' => 'title changed'
        ]);
        $result->assertStatus(403);
    }

    /** @test */
    function it_can_delete_datasource()
    {
        $dataSource = create(DataSource::class);
        signIn($dataSource->owner);

        $this->deleteJson(route('datasources.destroy', ['datasource' => $dataSource->id]))
            ->assertStatus(202);
        $this->assertNull(DataSource::find($dataSource->id));
    }

}
