<?php

it('should parse boolean attributes', function () {
    $attributes = [
        'foo'    => true,
        'bar'    => false,
        'baz'    => 0,
        'docker' => 'container',
        'sail'   => 'laravel',
    ];

    $bag = new \WireUi\View\ComponentAttributesBag($attributes);

    expect($bag->getAttributes())->toBe([
        'foo'    => 'true',
        'bar'    => 'false',
        'baz'    => 0,
        'docker' => 'container',
        'sail'   => 'laravel',
    ]);
});
