<?php

namespace Tests\Unit\Providers;

dataset('wire::modifiers', [
    [
        'attribute' => 'wire:model.live',
        'expected' => [
            'live' => true,
            'blur' => false,
            'debounce' => [
                'exists' => false,
                'delay' => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.blur',
        'expected' => [
            'live' => false,
            'blur' => true,
            'debounce' => [
                'exists' => false,
                'delay' => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.live.debounce',
        'expected' => [
            'live' => true,
            'blur' => false,
            'debounce' => [
                'exists' => true,
                'delay' => '750',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.live.debounce.700',
        'expected' => [
            'live' => true,
            'blur' => false,
            'debounce' => [
                'exists' => true,
                'delay' => '700',
            ],
        ],
    ],
    [
        'attribute' => 'wire:model.live.debounce.700ms',
        'expected' => [
            'live' => true,
            'blur' => false,
            'debounce' => [
                'exists' => true,
                'delay' => '700',
            ],
        ],
    ],
]);

dataset('spinner::modifier', [
    ['spinner', []],
    ['spinner.lazy', ['lazy']],
    ['spinner.lazy.lazy', ['lazy']],
    ['spinner.lazy..bar', ['lazy', 'bar']],
    ['spinner.lazy.foo.', ['lazy', 'foo']],
]);
