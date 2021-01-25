<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    private static $time = "/^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9])(\.([0-9]?[0-9]?[0-9]))?)?$/i";

    private static $mysql = "r.participant_id, SEC_TO_TIME(SUM(TIME_TO_SEC( r.time ))  
                            + SUM(microsecond(r.time))/1000000 
                            + SUM(TIME_TO_SEC( r.penality ))
                            + SUM(microsecond(r.penality))/1000000)
                            as tot_time";
    private static $pgsql = "r.participant_id, SUM( r.time )  
                            + SUM( r.penality )
                            as tot_time";

    public static function get_select()
    {
        return env('DB_CONNECTION') == 'pgsql' ? self::$pgsql : self::$mysql;
    }

    public static function get_validation_ret():array
    {
        return [
        'participant_id' => ["required", "exists:participants,id"]
        ];
    }

    public static function get_validation_create():array
    {
        return [
        'time' => ["required", "regex:".Result::$time],
        'penality' => ["required", "regex:".Result::$time],
        'participant_id' => ["required", "exists:participants,id"]
        ];
    }

    public function get_validation_update():array
    {
        return [
            'time' => ["required", "regex:".Result::$time],
            'penality' => ["required", "regex:".Result::$time],
            ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stage_id',
        'participant_id',
        'time',
        'penality',
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
