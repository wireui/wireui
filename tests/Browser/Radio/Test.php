<?php

namespace Tests\Browser\Radio;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
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

    /** @test */
    public function it_should_dont_see_the_input_error_message()
    {
        Livewire::test(Component::class)
            ->call('validateRadio')
            ->assertDontSee('input is required')
            ->assertHasErrors('errorless');
    }
}
