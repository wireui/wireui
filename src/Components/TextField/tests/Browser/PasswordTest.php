<?php

namespace WireUi\Components\TextField\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Features\SupportTesting\Testable;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class PasswordTest extends BrowserTestCase
{
    public function browser(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $password = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Password Browser Test</h1>

                    // test it_should_set_model_value_to_livewire
                    <x-password dusk="input" wire:model.live="password" label="Model Input" />

                    <span dusk="password-value">{{ $password }}</span>

                    // test it_should_change_the_input_type_when_clicking_on_the_view_password_icon
                    <x-password wire:key="show-password" name="show-password" label="Show Password" />
                </div>
                BLADE;
            }
        });
    }

    public function component(): Testable
    {
        return Livewire::test(new class() extends Component
        {
            public $password = null;

            protected $rules = ['password' => 'required'];

            protected $messages = ['password.required' => 'input cant be empty'];

            public function validateInput()
            {
                $this->validate();
            }

            public function resetInputValidation()
            {
                $this->resetValidation();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Password Livewire Test</h1>

                    // test it_should_see_label_and_corner_hint
                    <x-password label="Input 1" corner-hint="Corner 1" />

                    // test it_should_see_hint_and_prefix_and_not_see_suffix
                    <x-password
                        label="Input 1"
                        corner-hint="Corner 1"
                        hint="Hint 1"
                        prefix="Prefix 1"
                        suffix="Suffix 1"
                    />

                    // test it_should_not_see_prepend_and_append_slots
                    <x-password>
                        <x-slot name="prepend">
                            <a>prepend 1</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append 1</a>
                        </x-slot>
                    </x-password>

                    // test it_should_see_prefix_and_not_see_suffix_instead_append_or_prepend_slots
                    <x-password prefix="prefix 2" suffix="suffix 2">
                        <x-slot name="prepend">
                            <a>prepend 2</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append 2</a>
                        </x-slot>
                    </x-password>

                    // test it_should_see_input_error
                    <x-password wire:model.live="password" label="Model Input" />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_see_label_and_corner_hint(): void
    {
        $this->component()
            ->assertSee('Input 1')
            ->assertSee('Corner 1');
    }

    public function test_it_should_see_hint_and_prefix_and_not_see_suffix(): void
    {
        $this->component()
            ->assertSee('Hint 1')
            ->assertSee('Prefix 1')
            ->assertDontSee('Suffix 1');
    }

    public function test_it_should_not_see_prepend_and_append_slots(): void
    {
        $this->component()
            ->assertSee('prepend 1')
            ->assertDontSee('append 1')
            ->assertSeeHtml('<a>prepend 1</a>')
            ->assertDontSeeHtml('<a>append 1</a>');
    }

    public function test_it_should_see_prefix_and_not_see_suffix_instead_append_or_prepend_slots(): void
    {
        $this->component()
            ->assertDontSee('prefix 2')
            ->assertDontSee('suffix 2')
            ->assertSeeHtml('<a>prepend 2</a>')
            ->assertDontSeeHtml('<a>append 2</a>');
    }

    public function test_it_should_see_input_error(): void
    {
        $this->component()
            ->call('validateInput')
            ->assertSee('input cant be empty')
            ->call('resetInputValidation')
            ->assertDontSee('input cant be empty');
    }

    public function test_it_should_set_model_value_to_livewire(): void
    {
        $this->browser()
            ->type('password', 'password')
            ->waitForTextIn('@password-value', 'password');
    }

    public function test_it_should_change_the_input_type_when_clicking_on_the_view_password_icon(): void
    {
        $this->browser()
            ->assertSee('Show Password')
            ->assertAttribute('input[name="show-password"]', 'type', 'password')
            ->assertInputValue('show-password', '')
            ->type('show-password', 'secret')
            ->assertDontSee('secret')
            ->click('div[wire\\:key="show-password"] > label > div[name="form.wrapper.container.append"] > button > svg:not([style*=\'none\'])')
            ->assertAttribute('input[name="show-password"]', 'type', 'text')
            ->assertInputValue('show-password', 'secret');
    }
}
