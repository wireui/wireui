<?php

use Illuminate\Support\Facades\Route;
use WireUi\Controllers\{ButtonController, IconsController, WireUiAssetsController};

Route::name('wireui.')->prefix('/wireui')->group(function () {
    Route::get('icons/{style}/{icon}', [IconsController::class, 'getIcon'])
        ->where('style', '(outline|solid)')
        ->name('icons');

    Route::get('button', [ButtonController::class, 'render'])->name('render.button');

    Route::get('assets/scripts', [WireUiAssetsController::class, 'scripts'])->name('assets.scripts');
    Route::get('assets/styles', [WireUiAssetsController::class, 'styles'])->name('assets.styles');
});
