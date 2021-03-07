<?php

use Illuminate\Support\Facades\Route;
use WireUi\App\Http\Controllers\IconsController;

Route::get('/wireui/icons/{icon}/{style?}', [IconsController::class, 'getIcon'])->name('wireui.icons');
