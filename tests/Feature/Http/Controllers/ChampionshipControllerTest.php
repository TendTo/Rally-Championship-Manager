<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Championship;
use App\Models\Participant;

class ChampionshipControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the index route of the championship resource.
     *
     * @return void
     */
    public function test_index_route()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('championship.index'));

        $response->assertStatus(200);
    }

    /**
     * Test the index archived route of the championship resource.
     *
     * @return void
     */
    public function test_index_archived_route()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('championship.archived'));

        $response->assertStatus(200);
    }

    /**
     * Test the create route of the championship resource.
     *
     * @return void
     */
    public function test_create_route()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get(route('championship.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Test the store route of the championship resource.
     *
     * @return void
     */
    public function test_store_route()
    {
        $user = User::factory()->create();
        $name = $this->faker->firstName;
        $desc = $this->faker->realText;
        $date = $this->faker->date;

        $response = $this->actingAs($user)->post(
            route('championship.store'),
            [
                'name' => $name,
                'desc' => $desc,
                'date' => $date,
            ]
        );

        $response->assertRedirect(route('championship.index'));

        $this->assertDatabaseHas('championships', ['name'=>$name, 'desc'=>$desc, 'date'=>$date]);
    }

    /**
     * Test the show route of the championship resource.
     *
     * @return void
     */
    public function test_show_route()
    {
        $user = User::factory()->create();
        $championship = Championship::factory()->create();
        
        $response = $this->actingAs($user)->get(route('championship.show',  [$championship]));

        $response->assertStatus(200);
    }

    /**
     * Test the result route of the championship resource.
     *
     * @return void
     */
    public function test_result_route()
    {
        $user = User::factory()->create();
        $championship = Championship::factory()->create();

        $response = $this->actingAs($user)->get(route('championship.result',  [$championship]));

        $response->assertStatus(200);
    }
    
    /**
     * Test the edit route of the championship resource while unauthorized.
     *
     * @return void
     */
    public function test_edit_route_unathorized()
    {
        $user = User::factory()->create();
        $championship = Championship::factory()->create();
        
        $response = $this->actingAs($user)->get(route('championship.edit', [$championship]));
        
        $response->assertStatus(403);
    }
    
    /**
     * Test the edit route of the championship resource while authorized.
     *
     * @return void
     */
    public function test_edit_route_authorized()
    {
        $user = User::factory()->create();
        $championship = Championship::factory()->create();
        $participant = Participant::factory()->for($user)->for($championship)->create();
        $participant->update(['is_admin' => true]);

        $response = $this->actingAs($user)->get(route('championship.edit', [$championship]));

        $response->assertStatus(200);
    }

    /**
     * Test the update route of the championship resource while unauthorized.
     *
     * @return void
     */
    public function test_update_route_unauthorized()
    {
        $user = User::factory()->create();
        $championship = Championship::factory()->create();
        $name = $this->faker->firstName;
        $desc = $this->faker->realText;
        $date = $this->faker->date;

        $response = $this->actingAs($user)->patch(
            route('championship.update', [$championship]),
            [
                'name' => $name,
                'desc' => $desc,
                'date' => $date,
            ]
        );

        $response->assertStatus(403);

        $this->assertDatabaseMissing('championships', ['name'=>$name, 'desc'=>$desc, 'date'=>$date]);
    }

    /**
     * Test the update route of the championship resource while unauthorized.
     *
     * @return void
     */
    public function test_update_route_authorized()
    {
        $user = User::factory()->create();
        $championship = Championship::factory()->create();
        $participant = Participant::factory()->for($user)->for($championship)->create();
        $participant->update(['is_admin' => true]);
        $name = $this->faker->firstName;
        $desc = $this->faker->realText;
        $date = $this->faker->date;

        $response = $this->actingAs($user)->patch(
            route('championship.update', [$championship]),
            [
                'name' => $name,
                'desc' => $desc,
                'date' => $date,
            ]
        );

        $response->assertRedirect(route('championship.show', [$championship]));

        $this->assertDatabaseHas('championships', ['name'=>$name, 'desc'=>$desc, 'date'=>$date]);
    }

    /**
     * Test the delete route of the championship resource while unauthorized.
     *
     * @return void
     */
    public function test_delete_route_unauthorized()
    {
        $user = User::factory()->create();
        $championship = Championship::factory()->create();
        $championship_id = $championship->id;

        $response = $this->actingAs($user)->delete(route('championship.destroy', [$championship]));

        $response->assertStatus(403);

        $this->assertDatabaseHas('championships', ['id'=>$championship_id]);
    }

    /**
     * Test the update route of the championship resource while unauthorized.
     *
     * @return void
     */
    public function test_delete_route_authorized()
    {
        $user = User::factory()->create();
        $championship = Championship::factory()->create();
        $championship_id = $championship->id;
        $participant = Participant::factory()->for($user)->for($championship)->create();
        $participant->update(['is_admin' => true]);

        $response = $this->actingAs($user)->delete(route('championship.destroy', [$championship]));

        $response->assertRedirect(route('championship.index'));

        $this->assertDatabaseMissing('championships', ['id'=>$championship_id]);
    }
}
