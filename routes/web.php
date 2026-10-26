<?php

use App\Http\Controllers\ClasificationController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\ProductorController;
use App\Http\Controllers\ReviewController;;
use App\Http\Controllers\NationalityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//ruta generos
Route::resource('genders',GenderController::class);

//clasificaiones
Route::resource('clasificacions',ClasificationController::class);

//plataformas 
Route::resource('platforms',PlatformController::class);

//nacionalidaddes
Route::resource('nacionalities',NationalityController::class);

//productoras
Route::resource('productors',ProductorController::class);