<?php

namespace Tests\Feature;

use App\Record;
use App\Version;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordVersionAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_the_versions_of_a_record()
    {
        $version = create(Version::class);

        signIn();
        $this->getJson(route('records.versions.index', ['record' => $version->record]))
            ->assertStatus(200)
            ->assertSee($version->id);
    }

    /** @test */
    function records_block_the_right_route()
    {
        $this->postJson(route('records.versions.store', ['record' => 1]), [])
            ->assertStatus(401)->assertSee('Unauthenticated');
        $this->putJson(route('records.versions.update', ['record' => 1, 'version'=> 1]), [])
            ->assertStatus(401)->assertSee('Unauthenticated');
        $this->deleteJson(route('records.versions.destroy', ['record' => 1, 'version' => 1]), [])
            ->assertStatus(401)->assertSee('Unauthenticated');
    }

    /** @test */
    function it_can_create_version()
    {
//        $record = create(Record::class);
//
//        $this->postJson(route('records.versions.store', ['record' => $record]))
//        ->assertStatus(201);
    }

    /** @test */
    function it_can_update_version()
    {

    }

    /** @test */
    function it_can_delete_version()
    {

    }

}
