<?php

namespace Tests\Unit\Providers\Macros;

use Illuminate\View\ComponentAttributeBag;

test('should parse the wire modifiers', function (string $attribute, mixed $expected) {
    $bag = new ComponentAttributeBag([$attribute => 'name']);

    expect($bag->wireModifiers())->toBe($expected);
})->with([
    [
        'attribute' => 'wire:model.live',
        'expected'  => [
            'live'     => true,
            'blur'     => false,
            'debounce' => [
                'exists' => false,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.blur',
        'expected'  => [
            'live'     => false,
            'blur'     => true,
            'debounce' => [
                'exists' => false,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.live.debounce',
        'expected'  => [
            'live'     => false,
            'blur'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.live.debounce.700',
        'expected'  => [
            'live'     => false,
            'blur'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '700',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.live.debounce.700ms',
        'expected'  => [
            'live'     => false,
            'blur'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '700',
            ],
        ],
    ],
]);
