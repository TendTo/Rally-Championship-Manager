<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championship extends Model
{
    use HasFactory;

    public static $points = [
        0 => 25,
        1 => 18,
        2 => 15,
        3 => 12,
        4 => 10,
        5 => 8,
        6 => 6,
        7 => 4,
        8 => 2,
        9 => 1
    ];

    public static function get_validation_create():array
    {
        return [
        'name' => ["required", "string", "unique:championships"],
        'desc' => '',
        'date' => ["required", "date"],
        ];
    }

    public function get_validation_update():array
    {
        return [
        'name' => ["required", "string", "unique:championships,name,".$this->id],
        'desc' => '',
        'date' => ["required", "date"],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
        'date',
        'archived',
    ];

    public function rallies()
    {
        return $this->hasMany(Rally::class);
    }
    
    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
}
