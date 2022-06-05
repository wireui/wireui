<?php

namespace Tests\Browser\ConfirmDirective;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_call_confirm_notification_by_directive_with_alpine_js()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, DirectiveComponent::class)
                ->click('@button.alpine')
                ->waitForText('Alpine Confirmation')
                ->waitForText('AcceptAlpine')
                ->press('AcceptAlpine')
                ->waitForTextIn('@value', 'Accepted by Alpine');
        });
    }

    /** @test */
    public function it_should_call_confirm_notification_by_directive_js()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, DirectiveComponent::class)
                ->click('@button.js')
                ->waitForText('JS Confirmation')
                ->waitForText('AcceptJS')
                ->press('AcceptJS')
                ->waitForTextIn('@value', 'Accepted by JS');
        });
    }
}
