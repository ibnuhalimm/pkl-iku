<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Laravel\Fortify\Http\Responses\SuccessfulPasswordResetLinkRequestResponse;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    public function test_can_view_forgot_password_form()
    {
        $response = $this->get(route('password.request'));

        $response->assertStatus(200)
            ->assertViewIs('auth.forgot-password');
    }


    public function test_successfully_request_reset_link()
    {
        $user = User::factory()->create();

        $response = $this->post(route('password.email'), [
            'email' => $user->email
        ]);

        $response->assertStatus(302)
            ->assertSessionHas('status');
    }


    public function test_receive_error_if_email_not_filled()
    {
        $response = $this->post(route('password.email'), [
            'email' => ''
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors('email');
    }


    public function test_receive_error_if_email_not_valid()
    {
        $response = $this->post(route('password.email'), [
            'email' => 'invalid-email-format'
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors('email');
    }


    public function test_receive_error_if_email_not_found()
    {
        $response = $this->post(route('password.email'), [
            'email' => 'invalid.user.email@pkl-ku.test'
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors('email');
    }
}
