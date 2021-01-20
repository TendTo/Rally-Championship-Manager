<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    public static function get_validation_create():array
    {
        return [
            'car_id' => ['required', 'exists:cars,id'],
        ];
    }

    public function get_validation_update():array
    {
        return [
            'car_id' => ['required', 'exists:cars,id'],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'championship_id',
        'user_id',
        'car_id',
        'is_admin',
    ];

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

}
