<?php

use App\Http\Controllers\Frontend\MovieController;

Route::group(
    ['prefix' => 'play'],
    function () {
        Route::get('/{episodeNameId}/', [MovieController::class, 'play'])->name('play.index');
    }
);
