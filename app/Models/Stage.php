<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Stage extends Model
{
    use HasFactory;

    public static function get_validation_create():array
    {
        return [
        'name' => ["required", "string", Rule::unique('stages', 'name')->where(
            function ($query) {
                return $query->where('rally_id', '=', request('rally')->id);
            }
        )],
        'desc' => '',
        ];
    }

    public function get_validation_update():array
    {
        return [
        'name' => ["required", "string", Rule::unique('stages', 'name')->where(
            function ($query) {
                return $query->where('rally_id', '=', $this->rally->id);
            }
        )->ignore($this->id)],
        'desc' => '',
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
        'rally_id',
    ];

    public function rally()
    {
        return $this->belongsTo(Rally::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
