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

            $this->visit($browser, Component::class)
                ->assertSee('Enable Notifications')
                ->tap(fn () => $browser->script("document.getElementById('{$id}').click()"))
                ->assertChecked('toggle')
                ->waitUsing(7, 100, fn () => $browser->assertSeeIn('@toggle', 'true'))
                ->tap(fn () => $browser->script("document.getElementById('{$id}').click()"))
                ->assertNotChecked('toggle')
                ->click('@validate')
                ->waitUsing(7, 100, fn () => $browser->assertSee('accept it'));
        });
    }

    /** @test */
    public function it_should_dont_see_the_input_error_message()
    {
        Livewire::test(Component::class)
            ->call('validateToggle')
            ->assertDontSee('input is required')
            ->assertHasErrors('errorless');
    }
}
