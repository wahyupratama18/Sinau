<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Question extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'assignment_id',
        'question',
        'type',
        'score'
    ],

    /**
     * Casting
    */
    $casts = [
        'assignment_id' => 'integer',
        'question' => 'string',
        'type' => 'integer',
        'score' => 'integer'
    ];
}
