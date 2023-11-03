<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class MaskableInputTest extends BrowserTestCase
{
    public function component(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $singleMask = '1234';

            public $multipleMask = null;

            public $singleFormattedMask = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Maskable Input test</h1>

                    // test it_should_start_input_with_formatted_value
                    <span dusk="singleMaskValue">{{ $singleMask }}</span>
                    <x-maskable
                        label="Maskable"
                        mask="##.##"
                        wire:model.live="singleMask"
                    />

                    // test it_should_type_input_value_and_emit_formatted_value
                    <span dusk="singleFormattedMaskValue">{{ $singleFormattedMask }}</span>
                    <x-maskable
                        label="Maskable"
                        mask="##.##.SS"
                        wire:model.live="singleFormattedMask"
                        emit-formatted
                    />

                    // test it_should_type_input_value_and_apply_multiples_masks
                    <span dusk="multipleMaskValue">{{ $multipleMask }}</span>
                    <x-maskable
                        label="Maskable"
                        mask="['##.##', '##.##.##', '##.##.###']"
                        wire:model.live="multipleMask"
                        emit-formatted
                    />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_start_input_with_formatted_value(): void
    {
        $this->component()
            ->assertSeeIn('@singleMaskValue', '1234')
            ->assertInputValue('singleMask', '12.34');
    }

    public function test_it_should_type_input_value_and_emit_formatted_value(): void
    {
        $this->component()
            ->type('singleFormattedMask', '3245ABCD')
            ->waitTo(function (Browser $browser) {
                return $browser
                    ->assertSeeIn('@singleFormattedMaskValue', '32.45.AB')
                    ->assertInputValue('singleFormattedMask', '32.45.AB');
            });
    }

    public function test_it_should_type_input_value_and_apply_multiples_masks(): void
    {
        $this->component()
            ->type('multipleMask', '9876')
            ->waitForTextIn('@multipleMaskValue', '98.76')
            ->type('multipleMask', '987662')
            ->waitForTextIn('@multipleMaskValue', '98.76.62')
            ->type('multipleMask', '9876624')
            ->waitForTextIn('@multipleMaskValue', '98.76.624');
    }
}
