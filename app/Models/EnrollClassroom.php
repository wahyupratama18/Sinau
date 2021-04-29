<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class EnrollClassroom extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'enroll_id',
        'classroom_history_id',
        'announcement'
    ],

    /**
     * Casting
    */
    $casts = [
        'enroll_id' => 'integer',
        'classroom_history_id' => 'integer',
        'announcement' => 'string'
    ];
}
