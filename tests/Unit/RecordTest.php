<?php

namespace Tests\Unit;

use App\DataSource;
use App\Record;
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
}
