<?php

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

Route::get('/', function () {
    return view('sinau.index');
})->name('landing');

Route::get('/about', function () {
    return view('sinau.about');
})->name('about');

Route::get('/guru', function () {
    return view('sinau.guru');
})->name('guru');


Route::middleware('auth:sanctum')->group(function () {
    
    /**
     * Siswa Routes
    */
    Route::middleware('siswa')->group(function () {
    
        /**
         * Enrollments
        */
        Route::prefix('/enroll')->group(function() {
            
            /**
             * View All
            */
            Route::get('/', function () {
                return 'roll1';
            });
    
            /**
             * View by enroll id
            */
            Route::prefix('{id}')->group(function () {
                
                Route::get('/', function ($id) {
                    return $id;
                });
    
                /**
                 * Presence
                */
                Route::prefix('presence')->group(function () {
                    
                    Route::get('/', function ($id) {
                        return $id;
                    });
    
                    Route::get('/{presence}', function ($id, $presence) {
                        return $presence;
                    });
    
                });
    
    
            });
    
        });
    
    
    });
    
    
    /**
     * Guru Routes
    */
    Route::middleware('teacher')->group(function () {
        /**
         * Enrollments
        */
        Route::prefix('/enroll')->group(function() {
            
            /**
             * View All
            */
            Route::get('/', function () {
                return 'roll1';
            });
    
            /**
             * View by enroll id
            */
            Route::prefix('{id}')->group(function () {
                
                Route::get('/', function ($id) {
                    return $id;
                });
    
                /**
                 * Presence
                */
                Route::prefix('presence')->group(function () {
                    
                    Route::get('/', function ($id) {
                        return $id;
                    });
    
                    Route::get('/{presence}', function ($id, $presence) {
                        return $presence;
                    });
    
                });
    
    
            });
    
        });
    });
});