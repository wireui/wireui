<?php

namespace Tests\Browser\Select;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_show_validation_message()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->click('@validate')
                ->waitUsing(5, 75, fn () => $browser->assertSee('Select any value'));
        });
    }

    /** @test */
    public function it_should_select_one_option_from_simples_options_list()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script('
                    document.querySelector(\'input[name="model"]\').click();
                    document.querySelector(\'li[data-value="Array Option 2"]\').click();
                '))->waitUsing(5, 75, fn () => $browser->assertSeeIn('@model', 'Array Option 2'))
                ->tap(fn (Browser $browser) => $browser->script('
                    document.querySelector(\'input[name="model"]\').click();
                    document.querySelector(\'li[data-value="Array Option 1"]\').click();
                '))->waitUsing(5, 75, fn () => $browser->assertSeeIn('@model', 'Array Option 1'));
        });
    }

    /** @test */
    public function it_should_select_one_option_from_labeled_options_list()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script('
                    document.querySelector(\'input[name="model2"]\').click();
                    document.querySelector(\'li[data-value="2"]\').click();
                '))->waitUsing(5, 75, fn () => $browser->assertSeeIn('@model2', '2'))
                ->tap(fn (Browser $browser) => $browser->script('
                    document.querySelector(\'input[name="model2"]\').click();
                    document.querySelector(\'li[data-value="1"]\').click();
                '))->waitUsing(5, 75, fn () => $browser->assertSeeIn('@model2', '1'));
        });
    }

    /** @test */
    public function it_should_select_and_unselect_multiples_options()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script('
                    document.querySelector(\'input[name="model3"]\').click();
                    document.querySelector(\'li[data-value="A"]\').click();
                '))->waitUsing(5, 75, fn () => $browser->assertSeeIn('@model3', 'A'))
                ->tap(fn (Browser $browser) => $browser->script('
                    document.querySelector(\'li[data-value="B"]\').click();
                '))->waitUsing(5, 75, fn () => $browser->assertSeeIn('@model3', 'A,B'))
                ->tap(fn (Browser $browser) => $browser->script('
                    document.querySelector(\'li[data-value="A"]\').click();
                '))->waitUsing(5, 75, fn () => $browser->assertSeeIn('@model3', 'B'));
        });
    }

    /** @test */
    public function it_should_select_from_slot_list()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script('
                    document.querySelector(\'input[name="model4"]\').click();
                    document.querySelector(\'li[data-value="E"]\').click();
                '))->waitUsing(5, 75, fn () => $browser->assertSeeIn('@model4', 'E'));
        });
    }

    /** @test */
    public function it_should_cannot_select_readonly_and_disabled_options()
    {
        $this->browse(function (Browser $browser) {
            Livewire::visit($browser, Component::class)
                ->tap(fn (Browser $browser) => $browser->script('
                    document.querySelector(\'input[name="model5"]\').click();
                    document.querySelector(\'li[data-value="disabled"]\').click();
                    document.querySelector(\'li[data-value="readonly"]\').click();
                    document.querySelector(\'li[data-value="normal"]\').click();
                '))->waitUsing(5, 75, fn () => $browser->assertSeeIn('@model5', 'normal'));
        });
    }
}
