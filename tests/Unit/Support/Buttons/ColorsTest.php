<?php

use WireUi\Support\Buttons\Colors\Flat;
use WireUi\Support\Buttons\Colors\Outline;
use WireUi\Support\Buttons\Colors\Solid;

it('should return the a default color', function () {
    expect((new Flat())->default())->toBeTruthy();
    expect((new Outline())->default())->toBeTruthy();
    expect((new Solid())->default())->toBeTruthy();

    expect((new Flat())->get('default'))->toBeTruthy();
    expect((new Outline())->get('default'))->toBeTruthy();
    expect((new Solid())->get('default'))->toBeTruthy();
});

it('should return the all colors', function () {
    expect((new Flat())->all())->toBeTruthy();
    expect((new Outline())->all())->toBeTruthy();
    expect((new Solid())->all())->toBeTruthy();
});

it('should return the the colors keys', function () {
    expect((new Flat())->keys())->toBeTruthy();
    expect((new Outline())->keys())->toBeTruthy();
    expect((new Solid())->keys())->toBeTruthy();
});
