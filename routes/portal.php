<?php

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
})->name('login');

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('teacher:1')->group(function () {

        /**
         * Resources classrooms
        */
        Route::get('classrooms', function () {
            
        });

        /**
         * Resource departments
        */
        Route::get('departments', function () {
            
        });

        /**
         * Resource students
        */
        Route::get('students', function () {
            
        });

        /**
         * Resource Teachers
        */
        Route::get('teachers', function () {
            
        });

        /**
         * Resource Years
        */
        Route::get('years', function () {
            
        });

        /**
         * Resource Semesters
        */
        Route::get('semesters', function () {
            
        });

        /**
         * Resource New Schedules
        */
        Route::get('schedules', function () {
            
        });
        

    });

    Route::middleware('teacher:2')->group(function () {
        
    });

    Route::middleware('siswa')->group(function () {

        Route::get('/report', function () {
            
        });
    });
});
