<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Participant::factory()
            ->count(1)
            ->for(\App\Models\Championship::first())
            ->for(\App\Models\User::first())
            ->create();
    }
}
