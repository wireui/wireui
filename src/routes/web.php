<?php

use Illuminate\Support\Facades\Route;
use WireUi\Controllers\{ButtonController, IconsController, WireUiAssetsController};

Route::name('wireui.')->prefix('/wireui')->group(function() {
    Route::get('icons/{style}/{icon}', [IconsController::class, 'getIcon'])
        ->where('style', '(outline|solid)')
        ->name('icons');

    Route::get('button', [ButtonController::class, 'render'])->name('render.button');

    Route::get('assets/js/wireui.js', [WireUiAssetsController::class, 'scripts'])->name('assets.scripts');
    Route::get('assets/css/wireui.css', [WireUiAssetsController::class, 'styles'])->name('assets.styles');
});
