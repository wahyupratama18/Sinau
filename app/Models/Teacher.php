<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Teacher extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'user_id',
        'nip'
    ],

    /**
     * Casting
    */
    $casts = [
        'user_id' => 'integer',
        'nip' => 'integer'
    ];
}
