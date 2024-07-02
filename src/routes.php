<?php

use Illuminate\Support\Facades\Route;
use WireUi\Http\Controllers\ButtonController;
use WireUi\Http\Controllers\IconsController;
use WireUi\Http\Controllers\WireUiAssetsController;

Route::name('wireui.')->prefix('/wireui')->group(function () {
    Route::get('button', ButtonController::class)->name('render.button');

    Route::get('assets/styles', [WireUiAssetsController::class, 'styles'])->name('assets.styles');

    Route::get('assets/scripts', [WireUiAssetsController::class, 'scripts'])->name('assets.scripts');

    Route::get('icons/{variant}/{icon}', IconsController::class)->where('variant', '(outline|solid|mini)')->name('icons');
});
