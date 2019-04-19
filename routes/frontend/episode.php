<?php

use App\Http\Controllers\Frontend\EpisodeController;

Route::group(
    ['prefix' => 'episode'],
    function () {
        Route::post('/top', [EpisodeController::class, 'top'])->name('episode.top');
    }
);
