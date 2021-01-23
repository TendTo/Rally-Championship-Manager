<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the login display is correctly shown
     *
     * @return void
     */
    public function test_login_displays_the_login_form()
    {
        $this->assertGuest($guard = null);

        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /**
     * Test if missing data raise proper errors
     *
     * @return void
     */
    public function test_login_displays_validation_errors()
    {
        $this->assertGuest($guard = null);
        
        $response = $this->post(route('login'));

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('password');
    }

    /**
     * Test if a valid user can login correctly
     *
     * @return void
     */
    public function test_login_authenticates_and_redirects_user()
    {
        $this->assertGuest($guard = null);

        $user = User::factory()->create();
        
        $response = $this->post(
            route('login'), [
            'email' => $user->email, 
            'password' => "password"]
        );

        $response->assertRedirect(route('championship.index'));
        $this->assertAuthenticatedAs($user);
    }
}
