<?php

namespace Tests\Browser\CurrencyInput;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_mask_currency_value()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->type('currency', '123456')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertInputValue('currency', '123,456');
                })->clear('currency')
                ->pause(100)
                ->type('currency', '12.5')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertInputValue('currency', '12.5');
                });
        });
    }

    /** @test */
    public function it_should_follow_livewire_model_changes()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->clear('currency')
                ->click('@button.change.currency')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertInputValue('currency', '12,345.67');
                });
        });
    }

    /** @test */
    public function it_should_type_currency_value_and_emit_formatted_value()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->clear('formattedCurrency')
                ->type('formattedCurrency', '123456')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser
                        ->assertSeeIn('@formattedCurrency', '123,456')
                        ->assertInputValue('formattedCurrency', '123,456');
                });
        });
    }

    /** @test */
    public function it_should_parse_custom_currencies_like_brazilian_real()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertInputValue('brazilCurrency', '123.456,99')
                ->append('brazilCurrency', '66')
                ->assertInputValue('brazilCurrency', '12.345.699,66');
        });
    }
}
