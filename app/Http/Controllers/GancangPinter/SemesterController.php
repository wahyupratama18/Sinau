<?php

namespace App\Http\Controllers\GancangPinter;

use App\Http\Controllers\Controller;
use App\Models\{
    EnrollClassroom,
    Semester,
    TeacherRole
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{

    /**
     * Index View
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    */
    public function index()
    {
        if (Auth::check()) 
            return $this->semester(Semester::where('active', 1)->first());
            
        return view('sinau.index-guest');
    }
        
        
    /**
     * Auth Only By Semester
     * @param \App\Models\Semester $semester
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function semester(Semester $semester)
    {
        return view('sinau.index-admin', [
            'semester' => Semester::with('year')
            ->orderByDesc('active')
            ->orderByDesc('id')->get(),
            'lesson' => Auth::user()->teacher ?
            $this->teacher($semester->id) :
            $this->siswa($semester->id)
        ]);
    }


    /**
     * Siswa Only
     * @param int $semester
     * @return mixed
    */
    private function siswa(int $semester)
    {
        return EnrollClassroom::whereHas('enroll', function($q) use ($semester) {
            $q->where('semester_id', $semester)->with(['course', 'teacher.user']);
        })->whereHas('history', function($q) {
            return $q->whereHas('stClass', function($r) {
                return $r->where('student_id', Auth::user()->student->id);
            })->with('classroom.department');
        })->get();
    }


    /**
     * Teacher Only
     * @param int $semester
     * @return \Illuminate\Database\Eloquent\Collection<mixed, \Illuminate\Database\Eloquent\Builder>
    */
    private function teacher(int $semester)
    {
        $teach = Auth::user()->teacher->id;
        $enroll = EnrollClassroom::with('history.classroom.department');

        // SuperAdmin
        if (TeacherRole::where('teacher_id', $teach)
        ->where('role', 1)->first()) {

            return $enroll->whereHas('enroll', function($q) use ($semester) {
                $q->where('semester_id', $semester)->with(['course', 'teacher.user']);
            })->get();
            
        } else {

            return $enroll->whereHas('enroll', function($q) use ($semester, $teach) {
                $q->where('semester_id', $semester)
                ->where('teacher_id', $teach)
                ->with(['course', 'teacher.user']);
            })->get();
        }

    }

}
