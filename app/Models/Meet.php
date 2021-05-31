<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Meet extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'enroll_classroom_id',
        'title',
        'date'
    ],

    /**
     * Casting
    */
    $casts = [
        'enroll_classroom_id' => 'integer',
        'title' => 'string',
        'date' => 'date'
    ];
}
