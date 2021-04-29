<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Option extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'question_id',
        'values',
        'is_correct'
    ],

    /**
     * Casting
    */
    $casts = [
        'question_id' => 'integer',
        'values' => 'string',
        'is_correct' => 'boolean'
    ];
}
