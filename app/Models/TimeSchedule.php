<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class TimeSchedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'day',
        'ordered',
        'time_start',
        'time_end'
    ],

    /**
     * Casting
    */
    $casts = [
        'day' => 'integer',
        'ordered' => 'integer',
        'time_start' => 'time',
        'time_end' => 'time'
    ];
}
