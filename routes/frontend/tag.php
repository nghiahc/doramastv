<?php

use App\Http\Controllers\Frontend\TagController;

Route::group(
    ['prefix' => 'tags'],
    function () {
        Route::get('/{tag}', [TagController::class, 'index'])->name('tag.index');
    }
);
