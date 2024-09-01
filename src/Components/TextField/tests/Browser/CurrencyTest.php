<?php

namespace WireUi\Components\TextField\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class CurrencyTest extends BrowserTestCase
{
    public function test_it_should_mask_currency_value(): void
    {
        Livewire::visit(new class extends Component
        {
            public $currency = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$currency" />

                    <x-currency dusk="currency" wire:model.live="currency" label="Currency" />
                </div>
                BLADE;
            }
        })
            ->type('@currency', '123456')
            ->waitForTextIn('@value', '123456')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('@currency', '123,456'))
            ->clear('@currency')
            ->pause(100)
            ->type('@currency', '12.5')
            ->waitForTextIn('@value', '12.5')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('@currency', '12.5'));
    }

    public function test_it_should_follow_livewire_model_changes(): void
    {
        Livewire::visit(new class extends Component
        {
            public $currency = null;

            public function change(): void
            {
                $this->currency = 12345.67;
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$currency" />

                    <x-button dusk="button.change" wire:click="change" label="Change" />

                    <x-currency dusk="currency" wire:model.live="currency" label="Currency" />
                </div>
                BLADE;
            }
        })
            ->clear('@currency')
            ->click('@button.change')
            ->waitForTextIn('@value', '12345.67')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('@currency', '12,345.67'));
    }

    public function test_it_should_type_currency_value_and_emit_formatted_value(): void
    {
        Livewire::visit(new class extends Component
        {
            public $currency = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$currency" />

                    <x-currency
                        dusk="currency"
                        wire:model.live="currency"
                        label="Currency"
                        emit-formatted
                    />
                </div>
                BLADE;
            }
        })
            ->clear('@currency')
            ->type('@currency', '123456')
            ->waitForTextIn('@value', '123,456')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('@currency', '123,456'));
    }

    public function test_it_should_parse_custom_currencies_like_brazilian_real(): void
    {
        Livewire::visit(new class extends Component
        {
            public $currency = '123456,99';

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$currency" />

                    <x-currency
                        dusk="currency"
                        wire:model.live="currency"
                        label="Currency"
                        thousands="."
                        decimal=","
                        precision="2"
                    />
                </div>
                BLADE;
            }
        })
            ->waitForTextIn('@value', '123456.99')
            ->assertInputValue('@currency', '123.456,99')
            ->append('@currency', '66')
            ->waitForTextIn('@value', '12345699.66')
            ->assertInputValue('@currency', '12.345.699,66');
    }
}
