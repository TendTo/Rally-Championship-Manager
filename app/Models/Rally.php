<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

use App\Models\Championship;

class Rally extends Model
{
    use HasFactory;

    public static function get_validation_create(Championship $championship):array
    {
        return [
        'name' => ["required", "string", Rule::unique('rallies', 'name')->where(
            function ($query) {
                return $query->where('championship_id', '=', \request('championship')->id);
            }
        )],
        'desc' => '',
        'location' => ["required", "exists:locations,country_code"],
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
        'location' => ["required", "exists:locations,country_code"],
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
}
