<?php

use App\Http\Livewire\Portal\Admin\{
    ClassroomLivewire,
    CourseLivewire,
    DepartmentLivewire,
    EnrollLivewire,
    ScheduleLivewire,
    SemesterLivewire,
    StudentLivewire,
    TeacherLivewire,
    TimeLivewire,
    YearLivewire
};
use App\Http\Livewire\Portal\Siswa\{
    ReportLivewire
};
use Illuminate\Support\Facades\{Auth, Route};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) return redirect()->to('dashboard');
    return view('auth.login');
});

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('teacher:1')->name('admin.')->group(function () {

        Route::get('teachers', TeacherLivewire::class)->name('teacher');
        Route::get('departments', DepartmentLivewire::class)->name('department');
        Route::get('classrooms', ClassroomLivewire::class)->name('classroom');
        Route::get('students', StudentLivewire::class)->name('student');
        Route::get('years', YearLivewire::class)->name('year');
        Route::get('semesters', SemesterLivewire::class)->name('semester');
        Route::get('schedules', ScheduleLivewire::class)->name('schedule');
        Route::get('times', TimeLivewire::class)->name('times');
        Route::get('course', CourseLivewire::class)->name('course');
        Route::get('enroll', EnrollLivewire::class)->name('enroll');

    });

    Route::middleware('teacher:2')->group(function () {
        
    });

    Route::middleware('siswa')->name('report')->group(function () {

        Route::get('/report', ReportLivewire::class)->name('report');
    });
});
