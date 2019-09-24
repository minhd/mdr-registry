<?php

namespace Tests\Unit;

use App\Registry\Models\Record;
use App\Registry\Models\Schema;
use App\Registry\Models\Version;
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
}
