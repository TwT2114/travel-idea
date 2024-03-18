<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/searchByDestination', 'IdeaController@searchByDestination');
Route::get('/searchByTag', 'IdeaIdealController@searchByTag');
