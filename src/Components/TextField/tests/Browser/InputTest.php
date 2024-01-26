<?php

namespace WireUi\Components\TextField\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Features\SupportTesting\Testable;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class InputTest extends BrowserTestCase
{
    public function browser(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Input Browser Test</h1>

                    // test it_should_set_model_value_to_livewire
                    <x-input dusk="input" wire:model.live="model" label="Model Input" />

                    <span dusk="model-value">{{ $model }}</span>
                </div>
                BLADE;
            }
        });
    }

    public function component(): Testable
    {
        return Livewire::test(new class() extends Component
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
                    <h1>Input Livewire Test</h1>

                    // test it_should_see_label_and_corner
                    <x-input label="Input 1" corner="Corner 1" />

                    // test it_should_see_description_prefix_and_suffix
                    <x-input label="Input 1" corner="Corner 1" prefix="Prefix 1" suffix="Suffix 1" description="Description 1" />

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

                    // test it_should_see_input_error
                    <x-input wire:model.live="model" label="Model Input" />

                    // test it_should_dont_see_the_input_error_message
                    <x-input wire:model.live="errorless" label="Test error less" :errorless="true" />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_see_label_and_corner(): void
    {
        $this->component()
            ->assertSee('Input 1')
            ->assertSee('Corner 1');
    }

    public function test_it_should_see_description_prefix_and_suffix(): void
    {
        $this->component()
            ->assertSee('Prefix 1')
            ->assertSee('Suffix 1')
            ->assertSee('Description 1');
    }

    public function test_it_should_see_append_and_prepend_slots(): void
    {
        $this->component()
            ->assertSeeHtml('<a>prepend</a>')
            ->assertSeeHtml('<a>append</a>');
    }

    public function test_it_should_see_prefix_and_suffix_instead_append_or_prepend_slots(): void
    {
        $this->component()
            ->assertDontSee('prefix 2')
            ->assertDontSee('suffix 2')
            ->assertSeeHtml('<a>prepend 2</a>')
            ->assertSeeHtml('<a>append 2</a>');
    }

    public function test_it_should_see_input_error(): void
    {
        $this->component()
            ->call('validateInput')
            ->assertSee('input cant be empty')
            ->call('resetInputValidation')
            ->assertDontSee('input cant be empty');
    }

    public function test_it_should_dont_see_the_input_error_message(): void
    {
        $this->component()
            ->call('validateInput')
            ->assertDontSee('input is required')
            ->assertHasErrors('errorless');
    }

    public function test_it_should_set_model_value_to_livewire(): void
    {
        $this->browser()
            ->type('model', 'wireui@livewire-wireui.com')
            ->waitForTextIn('@model-value', 'wireui@livewire-wireui.com');
    }
}
