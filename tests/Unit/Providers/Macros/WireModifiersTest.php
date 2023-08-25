<?php

namespace Tests\Unit\Providers\Macros;

use Illuminate\View\ComponentAttributeBag;

test('should parse the wire modifiers', function (string $attribute, mixed $expected) {
    $bag = new ComponentAttributeBag([$attribute => 'name']);

    expect($bag->wireModifiers())->toBe($expected);
})->with([
    [
        'attribute' => 'wire:model.defer',
        'expected'  => [
            'defer'    => true,
            'lazy'     => false,
            'debounce' => [
                'exists' => false,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.lazy',
        'expected'  => [
            'defer'    => false,
            'lazy'     => true,
            'debounce' => [
                'exists' => false,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.debounce',
        'expected'  => [
            'defer'    => false,
            'lazy'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.debounce.700',
        'expected'  => [
            'defer'    => false,
            'lazy'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '700',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.debounce.700ms',
        'expected'  => [
            'defer'    => false,
            'lazy'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '700',
            ],
        ],
    ],
]);
