<?php

namespace Tests\Browser\PhoneInput;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_type_formatted_phone_number()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->type('phone', '0123456789')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@phone', '(012) 345-6789');
                })
                ->type('phone', '01234567890')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@phone', '+0 123 456-7890');
                })->type('phone', '012345678901')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@phone', '+01 23 4567-8901');
                });
        });
    }

    /** @test */
    public function it_should_type_custom_masked_phone_number()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->type('customPhone', '0123456789')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@customPhone', '(01) 2345-6789');
                })
                ->type('customPhone', '01234567890')
                ->waitUsing(7, 100, function () use ($browser) {
                    return $browser->assertSeeIn('@customPhone', '(01) 23456-7890');
                });
        });
    }
}
