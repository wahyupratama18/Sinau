<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class StudentClassroom extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'history_id',
        'student_id'
    ],

    /**
     * Casting
    */
    $casts = [
        'history_id' => 'integer',
        'student_id' => 'integer'
    ];


    /**
     * Student Data
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    /**
     * History
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function history()
    {
        return $this->belongsTo(ClassroomHistory::class);
    }
}
