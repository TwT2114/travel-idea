<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('idea', IdeaController::class)->middleware('auth');
Route::resource('user', UserController::class)->middleware('auth');

Route::get('/searchByDestination', 'IdeaController@searchByDestination');
Route::get('/searchByTag', 'IdeaController@searchByTag');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
