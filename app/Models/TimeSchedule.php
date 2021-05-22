<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class TimeSchedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
     * @var array
    */
    protected $fillable = [
        'day',
        'ordered',
        'time_start',
        'time_end'
    ],

    /**
     * Casting
     * @var array
    */
    $casts = [
        'day' => 'integer',
        'ordered' => 'integer',
    ],
    
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    $appends = ['day_name'];

    private $days = [
        1 => 'Senin',
        2 => 'Selasa',
        3 => 'Rabu',
        4 => 'Kamis',
        5 => 'Jum\'at',
        6 => 'Sabtu',
    ];

    /**
     * Get Schedule's Day Name
     * @return string
    */
    public function getDayNameAttribute()
    {
        return $this->days[$this->day];
    }

    /**
     * Get All Days
     * @return string[]
    */
    public function getAllDays()
    {
        return $this->days;
    }
}
