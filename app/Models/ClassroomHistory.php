<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class ClassroomHistory extends Model
{

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


    /**
     * Teacher
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }


    /**
     * Classroom
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }


    /**
     * Year
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function year()
    {
        return $this->belongsTo(Year::class);
    }


    /**
     * Students Classroom
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function stClass()
    {
        return $this->hasMany(StudentClassroom::class, 'history_id');
    }

}
