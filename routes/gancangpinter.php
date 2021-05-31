<?php

use App\Http\Controllers\GancangPinter\{
    EnrollController,
    MeetController,
    SemesterController
};

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

    
    /**
     * Enrollments
    */
    Route::resource('enroll', EnrollController::class)
    ->middleware('permission')
    ->only(['show', 'update']);

    Route::resource('enroll.meet', MeetController::class)
    ->middleware('permission')
    ->only(['create', 'store', 'show']);

});