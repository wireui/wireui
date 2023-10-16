<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class InputTest extends BrowserTestCase
{
    public function component(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $model = null;

            public $errorless = null;

            protected $rules = [
                'model'     => 'required',
                'errorless' => 'required',
            ];

            protected $messages = [
                'model.required'     => 'input cant be empty',
                'errorless.required' => 'input is required',
            ];

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
                    <h1>Input test</h1>

                    // test it_should_see_label_and_corner_hint
                    <x-input label="Input 1" corner-hint="Corner 1" />

                    // test it_should_see_hint_prefix_and_suffix
                    <x-input label="Input 1" corner-hint="Corner 1" hint="Hint 1" prefix="Prefix 1" suffix="Suffix 1" />

                    // test it_should_see_append_and_prepend_slots
                    <x-input>
                        <x-slot name="prepend">
                            <a>prepend</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append</a>
                        </x-slot>
                    </x-input>

                    // test it_should_see_prefix_and_suffix_instead_append_or_prepend_slots
                    <x-input prefix="prefix 2" suffix="suffix 2">
                        <x-slot name="prepend">
                            <a>prepend 2</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append 2</a>
                        </x-slot>
                    </x-input>

                    // test it_should_set_model_value_to_livewire
                    <x-input dusk="input" wire:model.live="model" label="Model Input" />

                    <span dusk="model-value">{{ $model }}</span>

                    // test it_should_dont_see_the_input_error_message
                    <x-input wire:model.live="errorless" label="Test error less" :errorless="true" />
                </div>

                BLADE;
            }
        });
    }

    public function test_it_should_see_label_and_corner_hint()
    {
        $this->component()
            ->assertSee('Input 1')
            ->assertSee('Corner 1');
    }

    public function test_it_should_see_hint_prefix_and_suffix()
    {
        $this->component()
            ->assertSee('Hint 1')
            ->assertSee('Prefix 1')
            ->assertSee('Suffix 1');
    }

    public function test_it_should_see_append_and_prepend_slots()
    {
        $this->component()
            ->assertSeeHtml('<a>prepend</a>')
            ->assertSeeHtml('<a>append</a>');
    }

    public function test_it_should_see_prefix_and_suffix_instead_append_or_prepend_slots()
    {
        $this->component()
            ->assertSee('prefix 2')
            ->assertSee('suffix 2')
            ->assertDontSeeHtml('<a>prepend 2</a>')
            ->assertDontSeeHtml('<a>append 2</a>');
    }

    public function test_it_should_see_input_error()
    {
        $this->component()
            ->call('validateInput')
            ->assertSee('input cant be empty')
            ->call('resetInputValidation')
            ->assertDontSee('input cant be empty');
    }

    public function test_it_should_set_model_value_to_livewire()
    {
        $this->component()
            ->type('model', 'wireui@livewire-wireui.com')
            ->waitForTextIn('@model-value', 'wireui@livewire-wireui.com');
    }

    public function test_it_should_dont_see_the_input_error_message()
    {
        $this->component()
            ->call('validateInput')
            ->assertDontSee('input is required')
            ->assertHasErrors('errorless');
    }
}
