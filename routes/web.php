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

Route::get('/search', [IdeaController::class, 'search'])->name('idea.search');
Route::get('/idea/{id}', [IdeaController::class, 'show']); // 显示单个创意的详情
Route::post('/idea/{id}/comment', [CommentController::class, 'store'])->name('comment.store');// 对创意添加评论
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
