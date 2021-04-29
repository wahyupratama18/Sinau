<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Year extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'start',
        'end'
    ],

    /**
     * Casting
    */
    $casts = [
        'start' => 'integer',
        'end' => 'integer'
    ];
}
