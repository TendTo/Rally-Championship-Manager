<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Location;
use App\Models\User;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    /**
     * Test if the registered user is correcly stored in the database
     *
     * @return void
     */
    public function test_register_creates_and_authenticates_a_user()
    {
        $name = $this->faker->firstName;
        $surname = $this->faker->lastName;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(8);
        $location_id = Location::factory()->create()->id;

        $response = $this->post(
            'register', [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'location_id' => $location_id,
            'birthday' => "1000-01-01",
            ]
        );

        $response->assertRedirect(route('championship.index'));
    
        $this->assertDatabaseHas('users', ['name'=>$name, 'email'=>$email]);

        $user = User::where('email', $email)->where('name', $name)->first();

        $this->assertNotNull($user);
        $this->assertAuthenticatedAs($user);
    }
}
