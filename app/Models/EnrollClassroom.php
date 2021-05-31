<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class EnrollClassroom extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'enroll_id',
        'history_id',
        'announcement'
    ],

    /**
     * Casting
    */
    $casts = [
        'enroll_id' => 'integer',
        'history_id' => 'integer',
        'announcement' => 'string'
    ];


    /**
     * Enroll
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function enroll()
    {
        return $this->belongsTo(Enroll::class);
    }


    /**
     * Schedules
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function schedule()
    {
        return $this->hasMany(EnrollSchedule::class);
    }


    /**
     * Classroom History
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function history()
    {
        return $this->belongsTo(ClassroomHistory::class);
    }


    /**
     * Meets
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function meet()
    {
        return $this->hasMany(Meet::class);
    }

}