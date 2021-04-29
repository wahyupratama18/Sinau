<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Semester extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'year_id',
        'remarks',
        'active'
    ],

    /**
     * Casting
    */
    $casts = [
        'year_id' => 'integer',
        'remarks' => 'integer',
        'active' => 'boolean'
    ];
}
