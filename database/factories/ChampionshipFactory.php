<?php

namespace Database\Factories;

use App\Models\Championship;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChampionshipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Championship::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> $this->faker->unique()->name,
            'desc'=>$this->faker->realText,
            'date'=>$this->faker->date,
        ];
    }
}