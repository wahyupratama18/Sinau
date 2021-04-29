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
}
