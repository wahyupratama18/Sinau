<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class TeacherRole extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'teacher_id',
        'role'
    ],

    /**
     * Casting
    */
    $casts = [
        'teacher_id' => 'integer',
        'role' => 'integer'
    ];
}
