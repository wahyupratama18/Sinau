<?php

namespace App\Http\Middleware;

use App\Models\{EnrollClassroom, TeacherRole};
use Closure;
use Illuminate\Http\Request;

class GancangPinterPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->user()->teacher->id ?? $request->user()->student->id;

        if (
            (
                $request->user()->student &&
                !EnrollClassroom::whereHas('history.stClass', function($q) use ($id) {
                    return $q->where('student_id', $id);
                })->findOrFail($request->enroll)
            ) || (
                $request->user()->teacher &&
                !TeacherRole::where('role', 1)->where('teacher_id', $id)->first() &&
                !EnrollClassroom::whereHas('enroll', function($q) use ($id) {
                    return $q->where('teacher_id', $id);
                })->findOrFail($request->enroll)
            )
        ) abort(404);

        return $next($request);
    }
}
