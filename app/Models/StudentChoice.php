<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class StudentChoice extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'student_answer_id',
        'option_id'
    ],

    /**
     * Casting
    */
    $casts = [
        'student_answer_id' => 'integer',
        'option_id' => 'integer'
    ];
}
