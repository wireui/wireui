<?php

namespace WireUi\Components\TextField\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class MaskableTest extends BrowserTestCase
{
    public function test_it_should_start_input_with_formatted_value(): void
    {
        Livewire::visit(new class extends Component
        {
            public $maskable = '1234';

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$maskable" />

                    <x-maskable dusk="maskable" wire:model.live="maskable" label="Maskable" mask="##.##" />
                </div>
                BLADE;
            }
        })
            ->assertSeeIn('@value', '1234')
            ->assertInputValue('@maskable', '12.34');
    }

    public function test_it_should_type_input_value_and_emit_formatted_value(): void
    {
        Livewire::visit(new class extends Component
        {
            public $maskable = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$maskable" />

                    <x-maskable
                        dusk="maskable"
                        wire:model.live="maskable"
                        label="Maskable"
                        mask="##.##.SS"
                        emit-formatted
                    />
                </div>
                BLADE;
            }
        })
            ->type('@maskable', '3245ABCD')
            ->waitForTextIn('@value', '32.45.AB')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('@maskable', '32.45.AB'));
    }

    public function test_it_should_type_input_value_and_apply_multiples_masks(): void
    {
        Livewire::visit(new class extends Component
        {
            public $maskable = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$maskable" />

                    <x-maskable
                        dusk="maskable"
                        wire:model.live="maskable"
                        label="Maskable"
                        :mask="['##.##', '##.##.##', '##.##.###']"
                        emit-formatted
                    />
                </div>
                BLADE;
            }
        })
            ->type('@maskable', '9876')
            ->waitForTextIn('@value', '98.76')
            ->type('@maskable', '987662')
            ->waitForTextIn('@value', '98.76.62')
            ->type('@maskable', '9876624')
            ->waitForTextIn('@value', '98.76.624');
    }
}
