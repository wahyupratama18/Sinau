<?php

use App\Http\Controllers\GancangPinter\{
    EnrollController,
    MaterialController,
    MeetController,
    PresenceController,
    SemesterController
};
use App\Http\Livewire\GancangPinter\PresenceLivewire;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [SemesterController::class, 'index'])->name('landing');

Route::view('/about', 'sinau.about')->name('about');

Route::view('/guru', 'sinau.guru')->name('guru');


Route::middleware('auth:sanctum')->group(function () {

    Route::get('semester/{semester}', [SemesterController::class, 'semester'])
    ->name('bySemester');

    Route::middleware('permission')->group(function () {
        
        Route::resource('enroll', EnrollController::class)
        ->only(['show', 'update']);
    
        Route::resource('enroll.meet', MeetController::class)
        ->only(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    
        Route::resource('enroll.meet.presence', PresenceController::class)
        ->only(['store'])->middleware('siswa');

        Route::resource('enroll.meet.material', MaterialController::class);

        Route::get('enroll/{enroll}/meet/{meet}/presence', PresenceLivewire::class)
        ->middleware('teacher')
        ->name('teacherPresence');

    });

});