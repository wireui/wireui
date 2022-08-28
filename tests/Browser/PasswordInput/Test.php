<?php

namespace Tests\Browser\PasswordInput;

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
    public function it_should_see_hint_and_prefix_and_not_see_suffix()
    {
        Livewire::test(Component::class)
            ->assertSee('Hint 1')
            ->assertSee('Prefix 1')
            ->assertDontSee('Suffix 1');
    }

    /** @test */
    public function it_should_not_see_prepend_and_append_slots()
    {
        Livewire::test(Component::class)
            ->assertSee('prepend 1')
            ->assertDontSee('append 1')
            ->assertDontSeeHtml('<a>prepend 1</a>')
            ->assertDontSeeHtml('<a>append 1</a>');
    }

    /** @test */
    public function it_should_see_prefix_and_not_see_suffix_instead_append_or_prepend_slots()
    {
        Livewire::test(Component::class)
            ->assertSee('prefix 2')
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
            ->call('resetInputValidation')
            ->assertDontSee('input cant be empty');
    }

    /** @test */
    public function it_should_set_model_value_to_livewire()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->type('password', 'password')
                ->waitForTextIn('@password-value', 'password');
        });
    }

    /** @test */
    public function it_should_change_the_input_type_when_clicking_on_the_view_password_icon()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, Component::class)
                ->assertSee('Show Password')
                ->assertAttribute('input[name="show-password"]', 'type', 'password')
                ->assertInputValue('show-password', '')
                ->type('show-password', 'secret')
                ->assertDontSee('secret')
                ->click('div[wire\\:key="show-password"] > div > div.relative > div.absolute > div > svg:not([style*=\'none\'])')
                ->assertAttribute('input[name="show-password"]', 'type', 'text')
                ->assertInputValue('show-password', 'secret');
        });
    }
}
