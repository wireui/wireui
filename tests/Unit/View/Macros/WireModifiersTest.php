<?php

namespace Tests\Unit\View\Macros;

use Illuminate\View\ComponentAttributeBag;

it('should parse the wire modifiers', function (string $attribute, array $expected) {
    $bag = new ComponentAttributeBag([$attribute => 'name']);

    $this->assertSame($bag->wireModifiers(), $expected);
})->with([
    [
        'wire:model.live',
        [
            'live'     => true,
            'blur'     => false,
            'debounce' => [
                'exists' => false,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'wire:model.blur',
        [
            'live'     => false,
            'blur'     => true,
            'debounce' => [
                'exists' => false,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'wire:model.live.debounce',
        [
            'live'     => true,
            'blur'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '750',
            ],
        ],
    ],
    [
        'wire:model.live.debounce.700',
        [
            'live'     => true,
            'blur'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '700',
            ],
        ],
    ],
    [
        'wire:model.live.debounce.700ms',
        [
            'live'     => true,
            'blur'     => false,
            'debounce' => [
                'exists' => true,
                'delay'  => '700',
            ],
        ],
    ],
]);
