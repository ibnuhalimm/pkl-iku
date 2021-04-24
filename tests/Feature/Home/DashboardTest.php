<?php

namespace Tests\Feature\Home;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function test_user_can_visit_dashboard_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->get('/');

        $response->assertStatus(200)
                ->assertViewIs('app.dashboard');
    }
}
