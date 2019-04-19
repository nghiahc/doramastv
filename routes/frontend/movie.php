<?php

use App\Http\Controllers\Frontend\MovieController;

Route::group(
    ['prefix' => 'movie'],
    function () {
        Route::get('/search/', [MovieController::class, 'search'])->name('movie.search');
        Route::get('/{titleId}/', [MovieController::class, 'index'])->name('movie.index');
    }
);
