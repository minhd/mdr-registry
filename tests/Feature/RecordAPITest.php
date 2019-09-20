<?php

namespace Tests\Feature;

use App\DataSource;
use App\Record;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordAPITest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shows_all_records()
    {
        signIn();
        create(Record::class, [], 100);
        $this->getJson(route('records.index'))->assertStatus(200);
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
    function can_create_record()
    {
        signIn();
        $valid = [
            'title' => 'sample record',
            'data_source_id' => factory(DataSource::class)->create()->id
        ];

        $this->postJson(route('records.store', $valid))
            ->assertStatus(201)->assertSee($valid['title']);
    }

    /** @test */
    function it_updates_records()
    {
        $user = signIn();
        $dataSource = create(DataSource::class, ['user_id' => $user->id]);
        $record = create(Record::class, ['data_source_id' => $dataSource->id]);
        $this->putJson(route('records.update', [
            'record' => $record->id,
            'title' => 'updated title'
        ]))->assertStatus(202)->assertSee('updated title');
    }

    /** @test */
    function it_can_delete_records()
    {
        signIn();
        $record = create(Record::class);
        $this->deleteJson(route('records.destroy', [
            'record' => $record->id
        ]))->assertStatus(202);
        $this->assertNull(Record::find($record->id));
    }
}
