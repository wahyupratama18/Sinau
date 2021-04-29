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
        'enroll_class_id',
        'title',
        'date'
    ],

    /**
     * Casting
    */
    $casts = [
        'enroll_class_id' => 'integer',
        'title' => 'string',
        'date' => 'date'
    ];
}
