<?php

namespace Tests\Unit;

use App\Record;
use App\Schema;
use App\Version;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VersionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_version_belongs_to_a_record()
    {
        $version = create(Version::class);
        $this->assertInstanceOf(Record::class, $version->record);
    }

    /** @test */
    function a_version_has_one_schema()
    {
        $version = create(Version::class);
        $this->assertInstanceOf(Schema::class, $version->schema);
    }
}
