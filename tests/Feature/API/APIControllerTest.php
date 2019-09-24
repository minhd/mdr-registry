<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APIControllerTest extends TestCase
{
    /* @test */
    public function test_it_shows_version_and_status()
    {
        $this->get('/api')->assertStatus(200)->assertJsonStructure(['version', 'status']);
    }
}
