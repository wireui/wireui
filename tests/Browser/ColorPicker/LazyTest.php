<?php

namespace Tests\Browser\ColorPicker;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class LazyTest extends BrowserTestCase
{
    /** @test */
    public function it_should_type_the_color_value_and_apply_only_when_the_component_loses_the_focus()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, LazyComponent::class)
                ->type('color', 'FFF')
                ->pause(500)
                ->assertInputValue('color', '#FFF')
                ->assertSeeIn('@model', '#00000')
                ->click('@model')
                ->waitForTextIn('@model', '#FFF')
                ->assertSeeIn('@model', '#FFF');
        });
    }
}
