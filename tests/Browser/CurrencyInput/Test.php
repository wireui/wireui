<?php

namespace Tests\Browser\CurrencyInput;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    public function test_it_should_mask_currency_value()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'CurrencyInput.view')
                ->type('currency', '123456')
                ->waitUsing(7, 100, fn () => $browser->assertInputValue('currency', '123,456'))
                ->clear('currency')
                ->pause(100)
                ->type('currency', '12.5')
                ->waitUsing(7, 100, fn () => $browser->assertInputValue('currency', '12.5'));
        });
    }

    public function test_it_should_follow_livewire_model_changes()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'CurrencyInput.view')
                ->clear('currency')
                ->click('@button.change.currency')
                ->waitUsing(7, 100, fn () => $browser->assertInputValue('currency', '12,345.67'));
        });
    }

    public function test_it_should_type_currency_value_and_emit_formatted_value()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'CurrencyInput.view')
                ->clear('formattedCurrency')
                ->type('formattedCurrency', '123456')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser
                        ->assertSeeIn('@formattedCurrency', '123,456')
                        ->assertInputValue('formattedCurrency', '123,456');
                });
        });
    }

    public function test_it_should_parse_custom_currencies_like_brazilian_real()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'CurrencyInput.view')
                ->assertInputValue('brazilCurrency', '123.456,99')
                ->append('brazilCurrency', '66')
                ->assertInputValue('brazilCurrency', '12.345.699,66');
        });
    }
}
