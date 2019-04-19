<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PolicyController;
use App\Http\Controllers\Frontend\ErrorController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/privacy-policy/', [PolicyController::class, 'policy'])->name('policy');
Route::get('/disclaimer/', [PolicyController::class, 'disclaimer'])->name('disclaimer');
Route::get('/404/', [ErrorController::class, 'get404'])->name('errors.404');
