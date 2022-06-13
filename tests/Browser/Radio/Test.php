<?php

namespace Tests\Browser\Radio;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_with_label_and_change_value()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Laravel')
                ->assertSee('Livewire')
                ->click('@validate')
                ->waitUsing(7, 100, fn () => $browser->assertSee('select one'))
                ->radio('radio', 'Laravel')
                ->assertRadioSelected('radio', 'Laravel')
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@radio', 'Laravel'))
                ->radio('radio', 'Livewire')
                ->assertRadioSelected('radio', 'Livewire')
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@radio', 'Livewire'));
        });
    }
}
