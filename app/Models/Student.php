<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Student extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'id',
        'user_id',
        'active'
    ],

    /**
     * Casting
    */
    $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'active' => 'integer'
    ];

    /**
     * Disable Incrementing
    */
    public $incrementing = false;
    
    
    /**
     * User Connection
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Classrooms
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function classroom()
    {
        return $this->hasMany(StudentClassroom::class);
    }


    /**
     * Presensi
    */
    public function presensi()
    {
        return $this->hasMany(PresenceMeet::class);
    }
}
