<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('idea', IdeaController::class)->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');
Route::resource('comment', CommentController::class)->middleware('auth');

Route::get('/search', [IdeaController::class, 'search'])->name('idea.search');
Route::get('/idea/{id}', [IdeaController::class, 'show'])->name('idea.show');
Route::post('/api/comments', [CommentController::class, 'store']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
