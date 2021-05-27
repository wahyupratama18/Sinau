<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class EnrollSchedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'enroll_classroom_id',
        'time_schedule_id'
    ],

    /**
     * Casting
    */
    $casts = [
        'enroll_classroom_id' => 'integer',
        'time_schedule_id' => 'integer'
    ];


    /**
     * Time Schedules
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function time()
    {
        return $this->belongsTo(TimeSchedule::class, 'time_schedule_id');
    }
}
