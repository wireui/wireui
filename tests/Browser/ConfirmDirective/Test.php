<?php

namespace Tests\Browser\ConfirmDirective;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_call_confirm_notification_by_directive_with_alpine_js()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->click('@button.alpine')
                ->waitUsing(5, 75, fn () => $browser->assertSee('Alpine Confirmation'))
                ->waitUsing(5, 75, fn () => $browser->assertSee('Confirm'))
                ->pause(100)
                ->press('Confirm')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@value', 'Accepted by Alpine'));
        });
    }

    /** @test */
    public function it_should_call_confirm_notification_by_directive_js()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->click('@button.js')
                ->waitUsing(5, 75, fn () => $browser->assertSee('JS Confirmation'))
                ->waitUsing(5, 75, fn () => $browser->assertSee('Confirm'))
                ->pause(100)
                ->press('Confirm')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@value', 'Accepted by JS'));
        });
    }
}
