<?php

namespace Tests\Browser\Checkbox;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_with_label_and_change_value()
    {
        $this->browse(
            fn (Browser $browser) => $this
                ->visit($browser, CheckComponent::class)
                ->assertSee('Remember me')
                ->check('checkbox')
                ->assertChecked('checkbox')
                ->waitForTextIn('@checkbox', 'true')
                ->uncheck('checkbox')
                ->assertNotChecked('checkbox')
                ->waitForTextIn('@checkbox', 'false')
                ->click('@validate')
                ->waitForText('accept it')
        );
    }
}
