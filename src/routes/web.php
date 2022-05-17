<?php

use Illuminate\Support\Facades\Route;
use WireUi\Http\Controllers\{ButtonController, IconsController, WireUiAssetsController};

Route::name('wireui.')->prefix('/wireui')->group(function () {
    Route::get('icons/{style}/{icon}', IconsController::class)
        ->where('style', '(outline|solid)')
        ->name('icons');

    Route::get('button', ButtonController::class)->name('render.button');

    Route::get('assets/scripts', [WireUiAssetsController::class, 'scripts'])->name('assets.scripts');
    Route::get('assets/styles', [WireUiAssetsController::class, 'styles'])->name('assets.styles');
});
