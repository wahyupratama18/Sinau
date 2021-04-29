<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Course extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'abbr',
        'name',
        'description'
    ],

    /**
     * Casting
    */
    $casts = [
        'abbr' => 'string',
        'name' => 'string',
        'description' => 'string'
    ];
}
