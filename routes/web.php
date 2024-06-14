<?php

use App\Http\Controllers\ForecastController;
use Illuminate\Support\Facades\Route;

Route::post('/forecast/store', [ForecastController::class,'store'])->name('forecast.store');
Route::get('/forecast/create', [ForecastController::class,'create'])->name('forecast.create');
Route::get('/forecast/compare', [ForecastController::class,'compare'])->name('forecast.compare');
Route::get('/forecast', [ForecastController::class,'index'])->name('forecast.index');

Route::get('/', function () {
    return view('welcome');
});
