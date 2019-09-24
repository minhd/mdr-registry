<?php

namespace Tests\Unit;

use App\Registry\Models\DataSource;
use App\Registry\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataSourceTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    function a_datasource_has_an_owner()
    {
        $john = create(User::class);
        $ds = create(DataSource::class, ['user_id' => $john->id]);

        $this->assertEquals($ds->owner->id, $john->id);
    }
}
