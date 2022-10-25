<?php

namespace Tests\Browser\SliderInput;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_render_an_input_slider_with_the_default_min_and_max_values(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 1')
                ->assertSee('corner-hint test 1')
                ->assertSee('hint-test-1')
                ->assertValue('input[name="test1"]', '')
                ->click('input[name="test1"] + div')
                ->assertValue('input[name="test1"]', '50')
                ->assertSee('50')
                ->clickAndHold('input[name="test1"] + div > div:nth-child(2) > div > button')
                ->moveMouse(260, 0)
                ->releaseMouse()
                ->assertValue('input[name="test1"]', '76')
                ->clickAndHold('input[name="test1"] + div > div:nth-child(2) > div > button')
                ->moveMouse(-512, 0)
                ->releaseMouse()
                ->assertValue('input[name="test1"]', '25');
        });
    }

    /** @test */
    public function it_should_render_an_input_slider_with_the_custom_min_and_max_values(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 2')
                ->assertSee('corner-hint test 2')
                ->assertSee('hint-test-2')
                ->assertValue('input[name="test2"]', '')
                ->click('input[name="test2"] + div')
                ->assertValue('input[name="test2"]', '5.5')
                ->assertSee('5.5')
                ->clickAndHold('input[name="test2"] + div > div:nth-child(2) > div > button')
                ->moveMouse(260, 0)
                ->releaseMouse()
                ->assertValue('input[name="test2"]', '5.8')
                ->clickAndHold('input[name="test2"] + div > div:nth-child(2) > div > button')
                ->moveMouse(-512, 0)
                ->releaseMouse()
                ->assertValue('input[name="test2"]', '5.3');
        });
    }

    /** @test */
    public function it_should_render_an_input_slider_without_tooltip(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 3')
                ->assertValue('input[name="test3"]', '')
                ->click('input[name="test3"] + div')
                ->assertValue('input[name="test3"]', '50')
                ->assertDontSee('50')
                ->clickAndHold('input[name="test3"] + div > div:nth-child(2) > div > button')
                ->moveMouse(260, 0)
                ->releaseMouse()
                ->assertValue('input[name="test3"]', '75')
                ->clickAndHold('input[name="test3"] + div > div:nth-child(2) > div > button')
                ->moveMouse(-450, 0)
                ->releaseMouse()
                ->assertValue('input[name="test3"]', '30');
        });
    }

    /** @test */
    public function it_should_render_an_input_slider_with_stops(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 4')
                ->assertValue('input[name="test4"]', '40')
                ->click('input[name="test4"] + div')
                ->assertValue('input[name="test4"]', '60')
                ->clickAndHold('input[name="test4"] + div > div:nth-child(2) > div > button')
                ->moveMouse(160, 0)
                ->releaseMouse()
                ->assertValue('input[name="test4"]', '80')
                ->clickAndHold('input[name="test4"] + div > div:nth-child(2) > div > button')
                ->moveMouse(-660, 0)
                ->releaseMouse()
                ->assertValue('input[name="test4"]', '20');
        });
    }
}
