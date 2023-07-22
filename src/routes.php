<?php

use Illuminate\Support\Facades\Route;
use WireUi\Http\Controllers\ButtonController;
use WireUi\Http\Controllers\IconsController;
use WireUi\Http\Controllers\WireUiAssetsController;

/**
 * WireUi Routes.
 */
Route::name('wireui.')->prefix('/wireui')->group(function () {
    /**
     * Render Icons.
     */
    Route::get('icons/{variant}/{icon}', IconsController::class)
        ->where('variant', '(outline|solid|mini)')
        ->name('icons');

    /**
     * Render Button.
     */
    Route::get('button', ButtonController::class)->name('render.button');

    /**
     * Get WireUi Styles.
     */
    Route::get('assets/styles', [WireUiAssetsController::class, 'styles'])->name('assets.styles');

    /**
     * Get WireUi Scripts.
     */
    Route::get('assets/scripts', [WireUiAssetsController::class, 'scripts'])->name('assets.scripts');
});
