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
                ->assertValue('#input1', '')
                ->click('#input1 + div')
                ->assertValue('#input1', '50')
                ->waitUsing(1,100, fn() => $browser->assertSee('50'))
                ->clickAndHold('#input1 + div > div:nth-child(2) > div > button')
                ->moveMouse(260, 0)
                ->releaseMouse()
                ->assertValue('#input1', '76')
                ->clickAndHold('#input1 + div > div:nth-child(2) > div > button')
                ->moveMouse(-512, 0)
                ->releaseMouse()
                ->assertValue('#input1', '24');
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
                ->assertValue('#input2', '')
                ->click('#input2 + div')
                ->assertValue('#input2', '5.5')
                ->waitUsing(1,100, fn() => $browser->assertSee('5.5'))
                ->clickAndHold('#input2 + div > div:nth-child(2) > div > button')
                ->moveMouse(260, 0)
                ->releaseMouse()
                ->assertValue('#input2', '5.8')
                ->clickAndHold('#input2 + div > div:nth-child(2) > div > button')
                ->moveMouse(-512, 0)
                ->releaseMouse()
                ->assertValue('#input2', '5.3');
        });
    }

    /** @test */
    public function it_should_render_an_input_slider_without_tooltip(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 3')
                ->assertValue('#input3', '')
                ->click('#input3 + div')
                ->assertValue('#input3', '50')
                ->waitUsing(1,100, fn() => $browser->assertDontSee('50'))
                ->clickAndHold('#input3 + div > div:nth-child(2) > div > button')
                ->moveMouse(260, 0)
                ->releaseMouse()
                ->assertValue('#input3', '75')
                ->clickAndHold('#input3 + div > div:nth-child(2) > div > button')
                ->moveMouse(-450, 0)
                ->releaseMouse()
                ->assertValue('#input3', '30');
        });
    }

    /** @test */
    public function it_should_render_an_input_slider_with_stops(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 4')
                ->assertValue('#input4', '20')
                ->click('#input4 + div')
                ->assertValue('#input4', '40')
                ->clickAndHold('#input4 + div > div:nth-child(2) > div > button')
                ->moveMouse(330, 0)
                ->releaseMouse()
                ->assertValue('#input4', '80')
                ->clickAndHold('#input4 + div > div:nth-child(2) > div > button')
                ->moveMouse(-800, 0)
                ->releaseMouse()
                ->assertValue('#input4', '0');
        });
    }

    /** @test */
    public function it_should_render_an_input_slider_range_with_the_default_min_and_max_values(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 5')
                ->assertSee('corner-hint test 5')
                ->assertSee('hint-test-5')
                ->assertValue('#input51', '0')
                ->assertValue('#input52', '0')
                ->click('#input52 + div')
                ->assertValue('#input51', '0')
                ->assertValue('#input52', '50')
                ->waitUsing(1,100, fn() => $browser->assertSee('50'))
                ->clickAndHold('#input52 + div > div:nth-child(2) > div > button')
                ->moveMouse(260, 0)
                ->releaseMouse()
                ->assertValue('#input51', '27')
                ->assertValue('#input52', '50')
                ->clickAndHold('#input52 + div > div:nth-child(3) > div > button')
                ->moveMouse(270, 0)
                ->releaseMouse()
                ->assertValue('#input51', '27')
                ->assertValue('#input52', '77')
                ->clickAndHold('#input52 + div > div:nth-child(2) > div > button')
                ->moveMouse(600, 0)
                ->releaseMouse()
                ->assertValue('#input51', '77')
                ->assertValue('#input52', '87');
        });
    }

    /** @test */
    public function it_should_render_an_input_slider_range_with_the_custom_min_and_max_values(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 6')
                ->assertSee('corner-hint test 6')
                ->assertSee('hint-test-6')
                ->assertValue('#input61', '5')
                ->assertValue('#input62', '5')
                ->click('#input62 + div')
                ->assertValue('#input61', '5')
                ->assertValue('#input62', '5.5')
                ->waitUsing(1,100, fn() => $browser->assertSee('5.5'))
                ->clickAndHold('#input62 + div > div:nth-child(2) > div > button')
                ->moveMouse(260, 0)
                ->releaseMouse()
                ->assertValue('#input61', '5.3')
                ->assertValue('#input62', '5.5')
                ->clickAndHold('#input62 + div > div:nth-child(3) > div > button')
                ->moveMouse(120, 0)
                ->releaseMouse()
                ->assertValue('#input61', '5.3')
                ->assertValue('#input62', '5.6')
                ->clickAndHold('#input62 + div > div:nth-child(2) > div > button')
                ->moveMouse(560, 0)
                ->releaseMouse()
                ->assertValue('#input61', '5.6')
                ->assertValue('#input62', '5.9');
        });
    }

    /** @test */
    public function it_should_render_an_input_slider_range_without_tooltip(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 7')
                ->assertValue('#input71', '0')
                ->assertValue('#input72', '0')
                ->click('#input72 + div')
                ->assertValue('#input71', '0')
                ->assertValue('#input72', '50')
                ->waitUsing(1,100, fn() => $browser->assertDontSee('50'))
                ->clickAndHold('#input72 + div > div:nth-child(2) > div > button')
                ->moveMouse(770, 0)
                ->releaseMouse()
                ->assertValue('#input71', '50')
                ->assertValue('#input72', '80')
                ->clickAndHold('#input72 + div > div:nth-child(3) > div > button')
                ->moveMouse(-470, 0)
                ->releaseMouse()
                ->assertValue('#input71', '35')
                ->assertValue('#input72', '50');
        });
    }

    /** @test */
    public function it_should_render_an_input_slider_range_with_stops(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Test 8')
                ->assertValue('#input81', '20')
                ->assertValue('#input82', '60')
                ->click('#input82 + div')
                ->assertValue('#input81', '20')
                ->assertValue('#input82', '40')
                ->clickAndHold('#input82 + div > div:nth-child(2) > div > button')
                ->moveMouse(573, 0)
                ->releaseMouse()
                ->assertValue('#input81', '40')
                ->assertValue('#input82', '80')
                ->clickAndHold('#input82 + div > div:nth-child(3) > div > button')
                ->moveMouse(-622, 0)
                ->releaseMouse()
                ->assertValue('#input81', '20')
                ->assertValue('#input82', '40');
        });
    }
}
