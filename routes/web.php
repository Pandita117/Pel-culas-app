<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\ClasificationController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\ProductorController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

//generos 
Route::resource('generos', GenderController::class);
//clasificaciones
Route::resource('clasificaciones', ClasificationController::class);
//plataformas
Route::resource('plataformas', PlatformController::class);
//nacionalidades
Route::resource('nacionalidades', NationalityController::class);
//productoras
Route::resource('productoras', ProductorController::class);
//premios
Route::resource('awards', AwardController::class);

//actores
Route::resource('actors', ActorController::class);
//directores
Route::resource('directors', DirectorController::class);
//pelis
Route::resource('movies', MovieController::class);
//series
Route::resource('series', SerieController::class);
//reviews
Route::resource('reviews', ReviewController::class);