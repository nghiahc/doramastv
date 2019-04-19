<?php

use App\Http\Controllers\Frontend\CategoryController;

Route::group(
    ['prefix' => 'category'],
    function () {
        Route::get('/{name_url}', [CategoryController::class, 'index'])->name('category.index');
    }
);
