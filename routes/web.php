<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/searchByDestination', 'IdealController@searchByDestination');
Route::get('/searchByTag', 'IdealIdealController@searchByTag');
