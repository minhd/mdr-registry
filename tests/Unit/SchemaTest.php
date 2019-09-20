<?php

namespace Tests\Unit;

use App\Schema;
use App\User;
use Symfony\Component\VarDumper\Cloner\Data;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchemaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_schema_has_an_owner()
    {
        $schema = create(Schema::class);
        $this->assertInstanceOf(User::class, $schema->owner);
    }
}
