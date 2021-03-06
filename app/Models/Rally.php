<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Rally extends Model
{
    use HasFactory;

    public static function get_validation_create():array
    {
        return [
        'name' => ["required", "string", Rule::unique('rallies', 'name')->where(
            function ($query) {
                return $query->where('championship_id', '=', request('championship')->id);
            }
        )],
        'desc' => '',
        'location_id' => ["required", "exists:locations,id"],
        ];
    }

    public function get_validation_update():array
    {
        return [
        'name' => ["required", "string", Rule::unique('rallies', 'name')->where(
            function ($query) {
                return $query->where('championship_id', '=', $this->championship->id);
            }
        )->ignore($this->id)],
        'desc' => '',
        'location_id' => ["required", "exists:locations,id"],
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
        'location_id',
        'championship_id',
    ];

    public function championship()
    {
        return $this->belongsTo(Championship::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function results()
    {
        return $this->hasManyThrough(Result::class, Stage::class);
    }
}
