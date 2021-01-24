<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('db:country_names', function () {
    $locations = \App\Models\Location::all();
    foreach ($locations as $location){
        $data = ['country_name'=>\App\Models\Location::code_to_country($location->country_code)];
        $location->update($data);
    }
})->purpose('Set all the names of the countries');