<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Meet extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'enroll_classroom_id',
        'title',
        'date',
        'opened_at',
        'closed_at',
        'presence_opened',
        'presence_closed'
    ],

    /**
     * Casting
    */
    $casts = [
        'enroll_classroom_id' => 'integer',
        'title' => 'string',
        'date' => 'date',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
        'presence_opened' => 'time',
        'presence_closed' => 'time'
    ];
}
