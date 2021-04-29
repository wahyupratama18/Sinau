<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Enroll extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'semester_id',
        'course_id',
        'teacher_id',
        'course_increment'
    ],

    /**
     * Casting
    */
    $casts = [
        'semester_id' => 'integer',
        'course_id' => 'integer',
        'teacher_id' => 'integer',
        'course_increment' => 'integer'
    ];
}
