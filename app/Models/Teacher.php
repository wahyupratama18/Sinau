<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
     * @var array
    */
    protected $fillable = [
        'user_id',
        'nip'
    ],

    /**
     * Casting
     * @var array
    */
    $casts = [
        'user_id' => 'integer',
        'nip' => 'integer'
    ];


    /**
     * Teacher's role
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function role()
    {
        return $this->hasMany(TeacherRole::class);
    }

    
    /**
     * User Connection
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
