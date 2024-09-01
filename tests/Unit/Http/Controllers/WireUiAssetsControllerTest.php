<?php

namespace Tests\Unit\Http\Controllers;

use WireUi\Http\Controllers\WireUiAssetsController;

test('it should can pretend to be a file', function () {
    $controller = new WireUiAssetsController;

    expect($controller->scripts()->getContent())->not()->toBeNull();
    expect($controller->styles()->getContent())->not()->toBeNull();
});

test('it should make a request to the wireui scripts', function () {
    $this->get(route('wireui.assets.scripts'))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/javascript; charset=utf-8');
});

test('it should make a request to the wireui styles', function () {
    $this->get(route('wireui.assets.styles'))
        ->assertOk()
        ->assertHeader('Content-Type', 'text/css; charset=utf-8');
});
