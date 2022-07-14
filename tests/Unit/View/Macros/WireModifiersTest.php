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
        ];
    }
}
