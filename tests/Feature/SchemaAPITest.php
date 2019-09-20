<?php

namespace Tests\Feature;

use App\Schema;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchemaAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_all_schemas()
    {
        signIn();
        create(Schema::class, [], 100);
        $this->getJson(route('schemas.index'))->assertStatus(200);
    }

    /** @test */
    function records_block_the_right_route()
    {
        $this->postJson(route('records.store'), [])
            ->assertStatus(401)->assertSee('Unauthenticated');
        $this->putJson(route('records.update', ['record' => 1]), [])
            ->assertStatus(401)->assertSee('Unauthenticated');
        $this->deleteJson(route('records.destroy', ['record' => 1]), [])
            ->assertStatus(401)->assertSee('Unauthenticated');
    }

    /** @test */
    function can_create_schema()
    {
        signIn();
        $valid = [
            'schema_id' => 'iso19115-3',
            'description' => 'ISO/TS 19115-3:2016 defines an integrated XML implementation of ISO 19115‑1, ISO 19115‑2, and concepts from ISO/TS 19139 by defining the following artefacts:',
            'title' => 'ISO 19115-3',
            'format' => 'application/xml',
            'user_id' => factory(User::class)->create()->id
        ];

        $this->postJson(route('schemas.store', $valid))
            ->assertStatus(201)->assertSee($valid['title']);
    }

    /** @test */
    function it_updates_schemas()
    {
        $user = signIn();
        $schema = create(Schema::class, ['user_id' => $user->id]);

        $this->putJson(route('schemas.update', [
            'schema' => $schema->id,
            'title' => 'updated title'
        ]))->assertStatus(202)->assertSee('updated title');
    }

    /** @test */
    function it_can_delete_schemas()
    {
        signIn();
        $schema = create(Schema::class);
        $this->deleteJson(route('schemas.destroy', [
            'schema' => $schema->id
        ]))->assertStatus(202);
        $this->assertNull(Schema::find($schema->id));
    }
}
