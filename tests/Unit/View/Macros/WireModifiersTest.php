<?php

namespace Tests\Unit\View\Macros;

use Illuminate\View\ComponentAttributeBag;
use Tests\Unit\UnitTestCase;

class WireModifiersTest extends UnitTestCase
{
    /**
     * @test
     * @dataProvider modifiersProvider
     */
    public function it_should_parse_the_wire_modifiers(string $attribute, $expected)
    {
        $bag = new ComponentAttributeBag([$attribute => 'name']);

        $this->assertSame($bag->wireModifiers(), $expected);
    }

    public function modifiersProvider(): array
    {
        return [
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
                    'live'     => true,
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
                    'live'     => true,
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
                    'live'     => true,
                    'blur'     => false,
                    'debounce' => [
                        'exists' => true,
                        'delay'  => '700',
                    ],
                ],
            ],
        ];
    }
}
