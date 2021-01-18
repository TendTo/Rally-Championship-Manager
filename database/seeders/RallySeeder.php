<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RallySeeder extends Seeder
{
    private function get_random_location()
    {
        $id = random_int(1, 20);
        return  \App\Models\Location::find($id);
    }
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
                    ->for($this->get_random_location())
            )
            ->create();
    }
}
