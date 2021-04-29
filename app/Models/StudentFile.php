<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class StudentFile extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'student_answer_id',
        'name',
        'link'
    ],

    /**
     * Casting
    */
    $casts = [
        'student_answer_id' => 'integer',
        'name' => 'string',
        'link' => 'string'
    ];
}
