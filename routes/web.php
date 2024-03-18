<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/searchByDestination', 'SearchController@searchByDestination');
Route::get('/searchByTag', 'SearchController@searchByTag');
