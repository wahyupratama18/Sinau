<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class AssignmentFileType extends Model
{
    use HasFactory, SoftDeletes;


    /**
     * Fillable Items
    */
    protected $fillable = [
        'assignment_file_setting_id',
        'type_id'
    ],

    /**
     * Castings
    */
    $casts = [
        'assignment_file_setting_id' => 'integer',
        'type_id' => 'integer'
    ];

}
