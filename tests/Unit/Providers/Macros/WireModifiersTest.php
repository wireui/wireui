<?php

namespace Tests\Unit\Providers\Macros;

use Illuminate\View\ComponentAttributeBag;

test('it should parse the wire modifiers', function (string $attribute, mixed $expected) {
    $bag = new ComponentAttributeBag([$attribute => 'name']);

    expect($bag->wireModifiers())->toBe($expected);
})->with('wire::modifiers');
