<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\General\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class LoginControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function login_displays_the_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function login_displays_validation_errors()
    {
        $response = $this->post(route('login'), []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function login_authenticates_and_redirects_user()
    {
        // $user = factory(User::class)->create();

        $user = User::where('email', 'info@kisanmart.com')->first();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => '123456789'
        ]);

        $response->assertRedirect(route('dash.index'));
        $this->assertAuthenticatedAs($user);
    }
}
