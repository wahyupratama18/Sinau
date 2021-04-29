<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Presence extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'type'
    ],

    /**
     * Casting
    */
    $casts = [
        'type' => 'string'
    ];
}
