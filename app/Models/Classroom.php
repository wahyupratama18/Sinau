<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Classroom extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'level',
        'department_id',
        'group'
    ],

    /**
     * Casting
    */
    $casts = [
        'level' => 'string',
        'department_id' => 'integer',
        'group' => 'integer'
    ];
}
