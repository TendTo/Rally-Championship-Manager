<?php

namespace Database\Factories;

use App\Models\Rally;
use Illuminate\Database\Eloquent\Factories\Factory;

class RallyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rally::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "Rally ".$this->faker->name,
            'desc'=>$this->faker->realText,
        ];
    }
}
