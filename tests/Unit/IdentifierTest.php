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
        $id = factory(Identifier::class)->create();
        factory(Record::class)->create()->identifiers()->save($id);
        factory(Record::class)->create()->identifiers()->save($id);

        $this->assertCount(2, $id->records);
    }
}
