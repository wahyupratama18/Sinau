<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class StudentAnswer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'assignment_id',
        'student_id',
        'grade',
        'started_at',
        'finished_at'
    ],

    /**
     * Casting
    */
    $casts = [
        'assignment_id' => 'integer',
        'student_id' => 'integer',
        'grade' => 'integer',
        'started_at' => 'datetime',
        'finished_at' => 'datetime'
    ];
}
