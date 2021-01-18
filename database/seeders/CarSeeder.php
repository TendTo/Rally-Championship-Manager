<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Car::factory(10)->create();
    }
}
