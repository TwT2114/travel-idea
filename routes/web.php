<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/searchByDestination', 'IdeaController@searchByDestination');
Route::get('/searchByTag', 'IdeaController@searchByTag');
