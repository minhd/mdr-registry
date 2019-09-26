<?php

namespace Tests\Unit\IGSN;

use App\IGSN\Models\IGSN;
use App\IGSN\Models\IGSNClient;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IGSNTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_igsn_belongs_to_a_client()
    {
        $igsn = factory(IGSN::class)->create();
        $this->assertInstanceOf(IGSNClient::class, $igsn->owner);
    }
}
