<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RallySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Championship::factory()
            ->count(3)
            ->has(
                \App\Models\Rally::factory()
                    ->count(5)
                    ->for(\App\Models\Location::first())
            )
            ->create();
    }
}
