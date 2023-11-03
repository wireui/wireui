<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class CurrencyInputTest extends BrowserTestCase
{
    public function component(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $currency = null;

            public $formattedCurrency = null;

            public $brazilCurrency = '123.456,99';

            public function changeCurrency(): void
            {
                $this->currency = 12345.67;
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Currency Input test</h1>

                    // test it_should_mask_currency_value
                    // test it_should_follow_livewire_model_changes
                    <x-currency label="Currency" wire:model.live="currency" />
                    <button dusk="button.change.currency" wire:click="changeCurrency">
                        change
                    </button>

                    // test it_should_type_currency_value_and_emit_formatted_value
                    <x-currency label="Formatted Currency" emit-formatted wire:model.live="formattedCurrency" />
                    <span dusk="formattedCurrency">{{ $formattedCurrency }}</span>

                    // test it_should_parse_custom_currencies_like_brazilian_real
                    <x-currency thousands="." decimal="," precision="2" wire:model.live="brazilCurrency" />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_mask_currency_value()
    {
        $this->component()
            ->type('currency', '123456')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('currency', '123,456'))
            ->clear('currency')
            ->pause(100)
            ->type('currency', '12.5')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('currency', '12.5'));
    }

    public function test_it_should_follow_livewire_model_changes()
    {
        $this->component()
            ->clear('currency')
            ->click('@button.change.currency')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('currency', '12,345.67'));
    }

    public function test_it_should_type_currency_value_and_emit_formatted_value()
    {
        $this->component()
            ->clear('formattedCurrency')
            ->type('formattedCurrency', '123456')
            ->waitTo(function (Browser $browser) {
                return $browser
                    ->assertSeeIn('@formattedCurrency', '123,456')
                    ->assertInputValue('formattedCurrency', '123,456');
            });
    }

    public function test_it_should_parse_custom_currencies_like_brazilian_real()
    {
        $this->component()
            ->assertInputValue('brazilCurrency', '123.456,99')
            ->append('brazilCurrency', '66')
            ->assertInputValue('brazilCurrency', '12.345.699,66');
    }
}
