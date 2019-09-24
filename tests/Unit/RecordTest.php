<?php

namespace Tests\Unit;

use App\Registry\Models\DataSource;
use App\Registry\Models\Record;
use App\Registry\Models\Version;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_record_belongs_to_a_datasource()
    {
        $dataSource = create(DataSource::class);
        $record = create(Record::class, ['data_source_id' => $dataSource->id]);

        $this->assertEquals($record->datasource->id, $dataSource->id);
    }

    /** @test */
    function it_has_a_current_version()
    {
        $version = create(Version::class);
        $record = $version->record;

        $this->assertInstanceOf(Version::class, $record->current);
        $this->assertEquals($version->id, $record->current->id);
    }
}
