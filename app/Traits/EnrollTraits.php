<?php

namespace App\Traits;

use App\Models\EnrollClassroom;

/**
 * 
 */
trait EnrollTraits
{
    public function getCourse(int $enroll)
    {
        return EnrollClassroom::with(['enroll' => function ($q) {
            return $q->with('teacher.user')->with('course');
        }])->with('meet')->findOrFail($enroll);
    }
}
