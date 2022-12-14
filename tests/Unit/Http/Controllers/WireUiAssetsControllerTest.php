<?php

use WireUi\Http\Controllers\WireUiAssetsController;

use function Pest\Laravel\get;

it('can pretend to be a file', function () {
    $controller = new WireUiAssetsController();

    expect($controller->scripts()->getContent())->not()->toBeNull();
    expect($controller->styles()->getContent())->not()->toBeNull();
});

it('should make a request to the wireui scripts', function () {
    get(route('wireui.assets.scripts'))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/javascript; charset=utf-8');
});

it('should make a request to the wireui styles', function () {
    get(route('wireui.assets.styles'))
        ->assertOk()
        ->assertHeader('Content-Type', 'text/css; charset=utf-8');
});
