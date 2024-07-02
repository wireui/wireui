<?php

namespace Tests\Unit\View;

use WireUi\View\WireUiAttributeBag;

test('it should parse boolean attributes', function () {
    $attributes = [
        'foo' => true,
        'bar' => false,
        'baz' => 0,
        'docker' => 'container',
        'sail' => 'laravel',
    ];

    $bag = new WireUiAttributeBag($attributes);

    expect($bag->getAttributes())->toBe([
        'foo' => 'true',
        'docker' => 'container',
        'sail' => 'laravel',
    ]);
});
