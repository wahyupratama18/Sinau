<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class EnrollSchedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'enroll_classroom_id',
        'time_schedule_id'
    ],

    /**
     * Casting
    */
    $casts = [
        'enroll_classroom_id' => 'integer',
        'time_schedule_id' => 'integer'
    ];
}
