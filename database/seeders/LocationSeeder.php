<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Location::factory(20)->create();
        $locations = \App\Models\Location::all();
        foreach ($locations as $location){
            $data = ['country_name'=>\App\Models\Location::code_to_country($location->country_code)];
            $location->update($data);
        }
    }
}
