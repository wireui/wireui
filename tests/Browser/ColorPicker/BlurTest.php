<?php

namespace Tests\Browser\ColorPicker;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class BlurTest extends BrowserTestCase
{
    /** @test */
    public function it_should_type_the_color_value_and_apply_only_when_the_component_loses_the_focus()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'ColorPicker.view')
                ->type('blur', 'FFF')
                ->pause(500)
                ->assertInputValue('blur', '#FFF')
                ->assertSeeIn('@blur', '#00000')
                ->click('@blur')
                ->waitForTextIn('@blur', '#FFF')
                ->assertSeeIn('@blur', '#FFF');
        });
    }
}
