<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ClassroomHistory extends Model
{
    use HasFactory;

    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'classroom_id',
        'year_id',
        'teacher_id'
    ],

    /**
     * Casting
    */
    $casts = [
        'classroom_id' => 'integer',
        'year_id' => 'integer',
        'teacher_id' => 'integer'
    ];
}
