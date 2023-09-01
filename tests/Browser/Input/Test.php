<?php

namespace Tests\Browser\Input;

use Laravel\Dusk\Browser;
use Livewire\Volt\Volt;

test('it_should_see_label_and_corner_hint', function () {
    Volt::test('Input.view')
        ->assertSee('Input 1')
        ->assertSee('Corner 1');
});

test('it_should_see_hint_prefix_and_suffix', function () {
    Volt::test('Input.view')
        ->assertSee('Hint 1')
        ->assertSee('Prefix 1')
        ->assertSee('Suffix 1');
});

test('it_should_see_append_and_prepend_slots', function () {
    Volt::test('Input.view')
        ->assertSeeHtml('<a>prepend</a>')
        ->assertSeeHtml('<a>append</a>');
});

test('it_should_see_prefix_and_suffix_instead_append_or_prepend_slots', function () {
    Volt::test('Input.view')
        ->assertSee('prefix 2')
        ->assertSee('suffix 2')
        ->assertDontSeeHtml('<a>prepend 2</a>')
        ->assertDontSeeHtml('<a>append 2</a>');
});

test('it_should_see_input_error', function () {
    Volt::test('Input.view')
        ->call('validateInput')
        ->assertSee('input cant be empty')
        ->call('resetInputValidation')
        ->assertDontSee('input cant be empty');
});

test('it_should_set_model_value_to_livewire', function () {
    $this->browse(function (Browser $browser) {
        $this->visit($browser, 'Input.view')
            ->type('model', 'wireui@livewire-wireui.com')
            ->waitForTextIn('@model-value', 'wireui@livewire-wireui.com');
    });
});

test('it_should_dont_see_the_input_error_message', function () {
    Volt::test('Input.view')
        ->call('validateInput')
        ->assertDontSee('input is required')
        ->assertHasErrors('errorless');
});
