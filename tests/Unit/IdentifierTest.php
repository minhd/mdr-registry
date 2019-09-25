<?php

namespace Tests\Unit;

use App\Registry\Models\Identifier;
use App\Registry\Models\Record;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IdentifierTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_identifier_has_many_records()
    {
        $record = factory(Record::class)->create();
        $record2 = factory(Record::class)->create();

        $id = factory(Identifier::class)->create();
        $record->identifiers()->save($id);
        $record2->identifiers()->save($id);

        $this->assertCount(2, $id->records);
    }
}
