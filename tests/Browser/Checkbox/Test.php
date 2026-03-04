<?php

namespace Tests\Browser\Checkbox;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    public function test_it_should_render_with_label_and_change_value()
    {
        $this->browse(function (Browser $browser) {
            $browser->livewire(CheckComponent::class)
                ->assertSee('Remember me')
                ->check('checkbox')
                ->assertChecked('checkbox')
                ->waitForTextIn('@checkbox', 'true')
                ->uncheck('checkbox')
                ->assertNotChecked('checkbox')
                ->waitForTextIn('@checkbox', 'false')
                ->click('@validate')
                ->waitForText('accept it');
        });
    }
}
