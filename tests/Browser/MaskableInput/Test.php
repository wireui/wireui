<?php

namespace Tests\Browser\MaskableInput;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    public function test_it_should_start_input_with_formatted_value()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'MaskableInput.view')
                ->assertSeeIn('@singleMaskValue', '1234')
                ->assertInputValue('singleMask', '12.34');
        });
    }

    public function test_it_should_type_input_value_and_emit_formatted_value()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'MaskableInput.view')
                ->type('singleFormattedMask', '3245ABCD')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser
                        ->assertSeeIn('@singleFormattedMaskValue', '32.45.AB')
                        ->assertInputValue('singleFormattedMask', '32.45.AB');
                });
        });
    }

    public function test_it_should_type_input_value_and_apply_multiples_masks()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'MaskableInput.view')
                ->type('multipleMask', '9876')
                ->waitForTextIn('@multipleMaskValue', '98.76')
                ->type('multipleMask', '987662')
                ->waitForTextIn('@multipleMaskValue', '98.76.62')
                ->type('multipleMask', '9876624')
                ->waitForTextIn('@multipleMaskValue', '98.76.624');
        });
    }
}
