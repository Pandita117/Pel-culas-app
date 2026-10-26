<?php
use App\Http\Controllers\GenderController;
use App\Http\Controllers\ClasificationController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\ProductorController;
use App\Http\Controllers\AwardController; // o AwardsController
use App\Http\Controllers\ActorController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('generos', GenderController::class);
Route::resource('clasificaciones', ClasificationController::class);
Route::resource('plataformas', PlatformController::class);
Route::resource('nacionalidades', NationalityController::class);
Route::resource('productoras', ProductorController::class);
Route::resource('awards', AwardController::class);
Route::resource('actors', ActorController::class);
Route::resource('directors', DirectorController::class);
Route::resource('movies', MovieController::class);
Route::resource('series', SerieController::class);
Route::resource('reviews', ReviewController::class);