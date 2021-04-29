<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Material extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'meet_id',
        'title',
        'description',
        'type',
        'ordered_meet',
        'opened_at',
        'closed_at'
    ],

    /**
     * Casting
    */
    $casts = [
        'meet_id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'type' => 'integer',
        'ordered_meet' => 'integer',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime'
    ];
}
