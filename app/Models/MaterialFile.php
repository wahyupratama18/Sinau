<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class MaterialFile extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillables
    */
    protected $fillable = [
        'material_id',
        'name',
        'link'
    ],

    /**
     * Casting
    */
    $casts = [
        'material_id' => 'integer',
        'name' => 'string',
        'link' => 'string'
    ];
}
