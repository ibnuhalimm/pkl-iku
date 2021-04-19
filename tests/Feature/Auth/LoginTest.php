<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_can_view_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200)
            ->assertViewIs('auth.login');
    }


    public function test_can_login_using_username_password()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'username' => $user->username,
            'password' => $user->password
        ]);

        $response->assertStatus(302)
            ->assertLocation(route('home'));
    }


    public function test_can_login_using_email_password()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'username' => $user->email,
            'password' => $user->password
        ]);

        $response->assertStatus(302)
            ->assertLocation(route('home'));
    }


    public function test_cannot_login_using_invalid_credentials()
    {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'username' => $user->email,
            'password' => 'wrong-password'
        ]);

        $response->assertStatus(302)
            ->assertLocation(route('home'));
    }


    public function test_receive_validation_error_if_username_not_filled()
    {
        $response = $this->post(route('login'), [
            'username' => '',
            'password' => 'it-is-filled'
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors('username');
    }


    public function test_receive_validation_error_if_password_not_filled()
    {
        $response = $this->post(route('login'), [
            'username' => 'the-username-here',
            'password' => ''
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors('password');
    }
}
