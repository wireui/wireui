<?php

namespace Tests\Browser\Input;

use Laravel\Dusk\Browser;
use Livewire\Volt\Volt;
use Tests\Browser\BrowserTestCase;

class Test extends BrowserTestCase
{
    /** @test */
    public function it_should_see_label_and_corner_hint()
    {
        Volt::test('Input.view')
            ->assertSee('Input 1')
            ->assertSee('Corner 1');
    }

    /** @test */
    public function it_should_see_hint_prefix_and_suffix()
    {
        Volt::test('Input.view')
            ->assertSee('Hint 1')
            ->assertSee('Prefix 1')
            ->assertSee('Suffix 1');
    }

    /** @test */
    public function it_should_see_append_and_prepend_slots()
    {
        Volt::test('Input.view')
            ->assertSeeHtml('<a>prepend</a>')
            ->assertSeeHtml('<a>append</a>');
    }

    /** @test */
    public function it_should_see_prefix_and_suffix_instead_append_or_prepend_slots()
    {
        Volt::test('Input.view')
            ->assertSee('prefix 2')
            ->assertSee('suffix 2')
            ->assertDontSeeHtml('<a>prepend 2</a>')
            ->assertDontSeeHtml('<a>append 2</a>');
    }

    /** @test */
    public function it_should_see_input_error()
    {
        Volt::test('Input.view')
            ->call('validateInput')
            ->assertSee('input cant be empty')
            ->call('resetInputValidation')
            ->assertDontSee('input cant be empty');
    }

    /** @test */
    public function it_should_set_model_value_to_livewire()
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, 'Input.view')
                ->type('model', 'wireui@livewire-wireui.com')
                ->waitForTextIn('@model-value', 'wireui@livewire-wireui.com');
        });
    }

    /** @test */
    public function it_should_dont_see_the_input_error_message()
    {
        Volt::test('Input.view')
            ->call('validateInput')
            ->assertDontSee('input is required')
            ->assertHasErrors('errorless');
    }
}
