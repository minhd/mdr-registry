<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APIMeControllerTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    function test_it_does_not_return_anything_if_not_logged_in()
    {
        // 401 if json
        $this->getJson('/api/me')->assertStatus(401);

        // redirect to login page if not logged in
        $this->get('/api/me')->assertStatus(302)->assertRedirect(route('login'));
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_gets_current_user()
    {
        $john = signIn();

        $this->get('/api/me')->assertStatus(200)->assertSee($john->name)->assertSee($john->id);
    }
}
