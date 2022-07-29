<?php

namespace Tests\Browser\Tooltip;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_show_the_tooltip_when_hover_mouse_the_button()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Click Here 1')
                ->mouseover('@tooltip1')
                ->waitUsing(1, 100, fn () => $browser->assertSee('Tooltip 1'))
                ->moveMouse(600, 600)
                ->waitUsing(1, 100, fn () => $browser->assertDontSee('Tooltip 1'));
        });
    }

    /** @test */
    public function it_should_show_the_tooltip_when_click_in_the_button()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Click Here 2')
                ->click('@tooltip2')
                ->waitUsing(1, 100, fn () => $browser->assertSee('Tooltip 2'))
                ->click('@tooltip2')
                ->waitUsing(1, 100, fn () => $browser->assertDontSee('Tooltip 2'));
        });
    }

    /** @test */
    public function it_should_show_the_tooltip_when_click_in_the_button_and_it_will_disappear_in_2_seconds()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Click Here 3')
                ->click('@tooltip3')
                ->waitUsing(3, 100, fn () => $browser->assertSee('Tooltip 3'))
                ->waitUsing(3, 100, fn () => $browser->assertDontSee('Tooltip 3'));
        });
    }

    /** @test */
    public function it_should_show_the_tooltip_when_click_in_the_button_and_it_will_disappear_in_500_miliseconds()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Click Here 4')
                ->click('@tooltip4')
                ->waitUsing(1, 100, fn () => $browser->assertSee('Tooltip 4'))
                ->waitUsing(1, 100, fn () => $browser->assertDontSee('Tooltip 4'));
        });
    }
}
