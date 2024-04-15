<?php

use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanIdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('user', UserController::class)->middleware('auth');
Route::resource('idea', IdeaController::class)->middleware('auth');
Route::resource('comment', CommentController::class)->middleware('auth');
Route::resource('plan', PlanController::class)->middleware('auth');
Route::resource('plan_idea', PlanIdeaController::class)->middleware('auth');
Route::get('/idea/getPointsOfInterest/{id}', [IdeaController::class, 'getPointsOfInterest'])->name('idea.getPointsOfInterest');
Route::get('/search', [IdeaController::class, 'search'])->name('idea.search');
Route::post('/plan/addIdea', [PlanController::class, 'addIdea'])->name('plan.addIdea');
Route::delete('/plan/removeAllIdeas/{id}', [PlanController::class, 'removeAllIdeas'])->name('plan.removeAllIdeas');

Route::get('/user/{user}', 'App\Http\Controllers\UserController@show')->name('user.show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
