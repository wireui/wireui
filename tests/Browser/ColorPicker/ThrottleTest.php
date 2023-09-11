<?php

namespace Tests\Browser\ColorPicker;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class ThrottleTest extends BrowserTestCase
{
    /** @test */
    public function it_should_type_the_color_value_and_update_the_model_only_when_the_debounce_time_up()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'ColorPicker.view')
                ->type('throttle', 'F')
                ->pause(100)
                ->append('throttle', 'F')
                ->pause(100)
                ->append('throttle', 'F')
                ->pause(100)
                ->assertInputValue('throttle', '#FFF')
                ->assertSeeIn('@throttle', '#00000')
                ->pause(500)
                ->waitForTextIn('@throttle', '#FFF')
                ->assertSeeIn('@throttle', '#FFF');
        });
    }
}
