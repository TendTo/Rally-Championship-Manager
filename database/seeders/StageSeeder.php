<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Championship::factory()
            ->count(2)
            ->has(
                \App\Models\Rally::factory()
                    ->count(3)
                    ->for(\App\Models\Location::first())
                    ->has(
                        \App\Models\Stage::factory()
                        ->count(3)
                    )
            )
            ->create();
    }
}
