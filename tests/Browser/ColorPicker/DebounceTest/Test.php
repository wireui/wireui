<?php

namespace Tests\Browser\ColorPicker\DebounceTest;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_type_the_color_value_and_update_the_model_only_when_the_debounce_time_up()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'ColorPicker.DebounceTest.view')
                ->type('color', 'F')
                ->pause(100)
                ->append('color', 'F')
                ->pause(100)
                ->append('color', 'F')
                ->pause(100)
                ->assertInputValue('color', '#FFF')
                ->assertSeeIn('@model', '#00000')
                ->pause(500)
                ->waitForTextIn('@model', '#FFF')
                ->assertSeeIn('@model', '#FFF');
        });
    }
}
