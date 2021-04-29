<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class PresenceMeet extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'meet_id',
        'presence_id',
        'student_id',
        'remarks'
    ],

    /**
     * Casting
    */
    $casts = [
        'meet_id' => 'integer',
        'presence_id' => 'integer',
        'student_id' => 'integer',
        'remarks' => 'string'
    ];
}
