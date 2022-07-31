<?php

namespace Tests\Browser\NumberInput;

use Laravel\Dusk\Browser;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_see_label_and_corner_hint()
    {
        Livewire::test(Component::class)
            ->assertSee('Input 1')
            ->assertSee('Corner 1');
    }

    /** @test */
    public function it_should_see_hint_and_not_see_prefix_and_suffix()
    {
        Livewire::test(Component::class)
            ->assertSee('Hint 1')
            ->assertDontSee('Prefix 1')
            ->assertDontSee('Suffix 1');
    }

    /** @test */
    public function it_should_not_see_prepend_and_append_slots()
    {
        Livewire::test(Component::class)
            ->assertDontSeeHtml('<a>prepend</a>')
            ->assertDontSeeHtml('<a>append</a>');
    }

    /** @test */
    public function it_should_not_see_prefix_suffix_append_and_prepend()
    {
        Livewire::test(Component::class)
            ->assertDontSee('prefix 2')
            ->assertDontSee('suffix 2')
            ->assertDontSeeHtml('<a>prepend 2</a>')
            ->assertDontSeeHtml('<a>append 2</a>');
    }

    /** @test */
    public function it_should_see_input_error()
    {
        Livewire::test(Component::class)
            ->call('validateInput')
            ->assertSee('input cant be empty')
            ->set('number', 'text')
            ->call('validateInput')
            ->assertSee('input must be an integer')
            ->set('number', 11)
            ->call('validateInput')
            ->assertSee('input must be within the specified range')
            ->call('resetInputValidation')
            ->assertDontSee('input cant be empty')
            ->assertDontSee('input must be an integer')
            ->assertDontSee('input must be within the specified range');
    }

    /** @test */
    public function it_should_set_model_value_to_livewire()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->type('number', 8)
                ->waitForTextIn('@number-value', 8);
        });
    }

    /** @test */
    public function it_should_change_the_input_value_when_clicking_on_the_plus_or_minus_icon()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Show Number')
                ->assertInputValue('show-number', '')
                ->type('show-number', '2')
                ->click('div[wire\\:key="show-number"] > div > div.relative > div.right-0 > button')
                ->click('div[wire\\:key="show-number"] > div > div.relative > div.right-0 > button')
                ->assertInputValue('show-number', '4')
                ->click('div[wire\\:key="show-number"] > div > div.relative > div.left-0 > button')
                ->assertInputValue('show-number', '3');
        });
    }
}
