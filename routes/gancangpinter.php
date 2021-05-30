<?php

use App\Http\Controllers\GancangPinter\{
    EnrollController,
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
    Route::prefix('course/{enroll}')
    ->middleware('permission')
    ->name('course.')->group(function() {
          
        Route::get('/', [EnrollController::class, 'index'])->name('enroll');
        
        Route::get('create', function () {
            
        })->middleware('teacher');

        /**
         * Meet
        */
        Route::prefix('meet/{meet}')->name('meet.')->whereNumber('meet')->group(function () {
            
            Route::get('/', function ($enroll) {
                return $enroll;
            })->name('view');

            Route::get('/presence', function ($enroll, $presence) {
                return $presence;
            })->name('presence');

            Route::middleware('teacher')->group(function () {
               Route::get('update', function () {
                   
               }); 
            });

        });

    });
    
    
    /**
     * Guru Routes
    */
    // Route::middleware('teacher')->group(function () {
        
    //     /**
    //      * Enrollments
    //     */
    //     Route::prefix('/course/{enroll}')
    //     ->middleware('permission:1')
    //     ->name('course.')->group(function() {

    //         Route::get('/', function ($enroll) {
    //             return $enroll;
    //         })->name('enroll');

    //         /**
    //          * Presence
    //         */
    //         Route::prefix('presence')->group(function () {
                
    //             Route::get('/', function ($enroll) {
    //                 return $enroll;
    //             });

    //             Route::get('/{presence}', function ($enroll, $presence) {
    //                 return $presence;
    //             });

    //         });        
    
    //     });
    // });
});