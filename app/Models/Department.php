<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Department extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'abbr',
        'long'
    ],

    /**
     * Casting
    */
    $casts = [
        'abbr' => 'string',
        'long' => 'string'
    ];
}
