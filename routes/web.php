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

Route::get('/idea/{idea}/weather', [IdeaController::class, 'getWeather'])->name('idea.weather');
Route::get('/idea/getPointsOfInterest/{id}', [IdeaController::class, 'getPointsOfInterest'])
    ->name('idea.getPointsOfInterest');
Route::get('/search', [IdeaController::class, 'search'])->name('idea.search');

Route::post('/plan/addIdea', [PlanController::class, 'addIdea'])->name('plan.addIdea')->middleware('auth');
Route::get('/comment/delete/{id}', [CommentController::class, 'delete'])->name('comment.delete')->middleware('auth');

Route::delete('/plan/removeAllIdeas/{id}', [PlanController::class, 'removeAllIdeas'])
    ->name('plan.removeAllIdeas')
    ->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


