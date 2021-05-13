<?php

namespace Tests\Browser\Checkbox;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_with_label_and_change_value()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->assertSee('Remember me')
                ->check('checkbox')
                ->assertChecked('checkbox')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@checkbox', 'true'))
                ->uncheck('checkbox')
                ->assertNotChecked('checkbox')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@checkbox', 'false'))
                ->click('@validate')
                ->waitUsing(5, 75, fn () => $browser->assertSee('accept it'));
        });
    }
}
