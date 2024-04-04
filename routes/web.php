<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/searchByDestination', 'IdeaController@searchByDestination');
Route::get('/searchByTag', 'IdeaController@searchByTag');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
