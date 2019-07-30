<?php

use App\Http\Controllers\Frontend\MovieController;

Route::group(
    ['prefix' => 'video'],
    function () {
        Route::get('/{episodeNameId}/', [MovieController::class, 'video'])->name('video.index');
    }
);
