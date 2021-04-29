<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillable items
    */
    protected $fillable = [
        'material_id',
        'max_modified',
        'time_limit',
        'templates',
        'need_online_text'
    ],

    /**
     * Casting Data
    */
    $casts = [
        'material_id' => 'integer',
        'max_modified' => 'integer',
        'time_limit' => 'integer',
        'templates' => 'integer',
        'need_online_text' => 'integer'
    ];

}
