<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class AssignmentFileSetting extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Fillable Items
    */
    protected $fillable = [
        'assignment_id',
        'max_files',
        'max_size'
    ],

    /**
     * Casting
    */
    $casts = [
        'assignment_id' => 'integer',
        'max_files' => 'integer',
        'max_size' => 'integer'
    ];

}
