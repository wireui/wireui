<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Livewire\Testing\TestableLivewire;

class Component extends \Livewire\Component
{
    public ?string $color = '#001';

    public function render()
    {
        return <<<HTML
            <x-color-picker name="color-picker" value="#123" />
            <x-color-picker name="color-picker-wire" wire:model="color" />
            <x-color-picker :colors="['#123', '#456']" />
            <x-color-picker :colors="[['name'=>'FFF', 'value'=>'#FFF']]" />
        HTML;
    }
}

class ColorPickerTest extends BrowserTestCase
{
    /** @test */
    public function it_should_toggle_the_colors_dropdown()
    {
        $this->browse(function (Browser $browser) {
            /** @var Browser|TestableLivewire $testable */
            $testable = Livewire::visit($browser, Component::class);

            $testable
                ->click('@dropdown.toggle')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSee('dropdown-open');
                })
                ->click('@dropdown.toggle')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertDontSee('dropdown-open');
                });
        });
    }

    /** @test */
    public function it_should_select_a_color()
    {
        $this->browse(function (Browser $browser) {
            /** @var Browser|TestableLivewire $testable */
            $testable = Livewire::visit($browser, Component::class);

            $testable
                ->click('@dropdown.toggle')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSee('dropdown-open');
                })
                ->click('button[title="White"')
                ->pause(100)
                ->assertInputValue('color-picker', '#fff');
        });
    }

    /** @test */
    public function it_should_select_the_color_more_than_one_time()
    {
        $this->browse(function (Browser $browser) {
            /** @var Browser|TestableLivewire $testable */
            $testable = Livewire::visit($browser, Component::class);

            $testable
                ->click('@dropdown.toggle')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSee('dropdown-open');
                })
                ->click('button[title="White"')
                ->pause(100)
                ->assertInputValue('color-picker', '#fff')
                ->click('@dropdown.toggle')
                ->waitUsing(5, 75, function () use ($browser) {
                    return $browser->assertSee('dropdown-open');
                })
                ->click('button[title="Black"')
                ->pause(100)
                ->assertInputValue('color-picker', '#000');
        });
    }

    /** @test */
    public function it_should_type_the_color_value()
    {
        $this->browse(function (Browser $browser) {
            /** @var Browser|TestableLivewire $testable */
            $testable = Livewire::visit($browser, Component::class);

            $testable
                ->clear('color-picker')
                ->assertInputValue('color-picker', null)
                ->type('color-picker', 'ABC')
                ->assertInputValue('color-picker', '#ABC')
                ->type('color-picker', '123456789')
                ->assertInputValue('color-picker', '#123456');
        });
    }

    /** @test */
    public function it_should_auto_fill_the_color_from_input_element()
    {
        $this->browse(function (Browser $browser) {
            /** @var Browser|TestableLivewire $testable */
            $testable = Livewire::visit($browser, Component::class);

            $testable
                ->waitForLivewireToLoad()
                ->assertInputValue('color-picker', '#123');
        });
    }

    /** @test */
    public function it_should_auto_fill_the_color_from_wire_model()
    {
        $this->browse(function (Browser $browser) {
            /** @var Browser|TestableLivewire $testable */
            $testable = Livewire::visit($browser, Component::class);

            $testable
                ->waitForLivewireToLoad()
                ->assertInputValue('color-picker-wire', '#001');
        });
    }

    /** @test */
    public function it_should_pass_the_colors_to_js_component()
    {
        Livewire::test(Component::class)
            ->assertSee("colors: JSON.parse(atob('W3sibmFtZSI6IiMxMjMiLCJ2YWx1ZSI6IiMxMjMifSx7Im5hbWUiOiIjNDU2IiwidmFsdWUiOiIjNDU2In1d'))", false)
            ->assertSee("colors: JSON.parse(atob('W3sibmFtZSI6IkZGRiIsInZhbHVlIjoiI0ZGRiJ9XQ=='))", false);
    }
}
