<?php

namespace App\Http\Controllers\GancangPinter;

use App\Http\Controllers\Controller;
use App\Models\{EnrollClassroom};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollController extends Controller
{

    /**
     * Enrolls
    */
    public function index($enroll, Request $request)
    {
        return view('sinau.enroll.index', [
            'course' => EnrollClassroom::with(['enroll' => function ($q) {
                return $q->with('teacher.user')->with('course');
            }])->find($enroll)
        ]);
    }
}
