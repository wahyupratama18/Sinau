<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/post.create', [PostController::class, 'create']);
Route::get('/post.index', [PostController::class, 'store']);
Route::get('/post.store', [PostController::class, '']);