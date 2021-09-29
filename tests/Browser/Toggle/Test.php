<?php

namespace Tests\Browser\Toggle;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_label_and_change_value()
    {
        $this->browse(function (Browser $browser) {
            $id = md5('toggle');

            Livewire::visit($browser, Component::class)
                ->assertSee('Enable Notifications')
                ->tap(fn () => $browser->script("document.getElementById('{$id}').click()"))
                ->assertChecked('toggle')
                ->waitUsing(5, 75, fn () => $browser->assertSeeIn('@toggle', 'true'))
                ->tap(fn () => $browser->script("document.getElementById('{$id}').click()"))
                ->assertNotChecked('toggle')
                ->click('@validate')
                ->waitUsing(5, 75, fn () => $browser->assertSee('accept it'));
        });
    }
}
