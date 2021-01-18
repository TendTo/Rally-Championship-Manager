<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public static function get_location_id(String $country_code):int
    {
        return self::find(1)->where('country_code', '=', $country_code)->first()->id;
    }
}
