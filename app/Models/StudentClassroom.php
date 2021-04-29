<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class StudentClassroom extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'classroom_history_id',
        'student_id'
    ],

    /**
     * Casting
    */
    $casts = [
        'classroom_history_id' => 'integer',
        'student_id' => 'integer'
    ];
}
