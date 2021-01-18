<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public static function get_validation_create():array
    {
        return [
        'model' => ["required", "string"],
        'constructor' => ["required", "string"],
        'category' => ["required", "string"],
        ];
    }

    public function get_validation_update():array
    {
        return [
        'model' => ["required", "string"],
        'constructor' => ["required", "string"],
        'category' => ["required", "string"],
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'constructor',
        'category',
    ];
}
