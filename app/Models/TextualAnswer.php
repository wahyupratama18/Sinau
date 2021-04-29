<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class TextualAnswer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'student_answer_id',
        'question_id',
        'answer'
    ],

    /**
     * Casting
    */
    $casts = [
        'student_answer_id' => 'integer',
        'question_id' => 'integer',
        'answer' => 'string'
    ];
}
