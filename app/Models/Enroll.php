<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Enroll extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'semester_id',
        'course_id',
        'teacher_id',
        'course_increment'
    ],

    /**
     * Casting
    */
    $casts = [
        'semester_id' => 'integer',
        'course_id' => 'integer',
        'teacher_id' => 'integer',
        'course_increment' => 'integer'
    ];


    /**
     * My Course
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Teachers
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }


    /**
     * Semester
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

}
