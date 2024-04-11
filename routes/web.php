<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('idea', IdeaController::class)->middleware('auth');

Route::get('/search', [IdeaController::class, 'search'])->name('idea.search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
