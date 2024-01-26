<?php

namespace WireUi\Components\TextField\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Features\SupportTesting\Testable;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class NumberTest extends BrowserTestCase
{
    public function browser(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $number = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <h1>Number Browser Test</h1>

                    // test it_should_set_model_value_to_livewire
                    <x-number dusk="input" wire:model.live="number" label="Model Input" />

                    <span dusk="number-value">{{ $number }}</span>

                    // test it_should_change_the_input_value_when_clicking_on_the_plus_or_minus_icon
                    <x-number wire:key="show-number" name="show-number" label="Show Number" />
                </div>
                BLADE;
            }
        });
    }

    public function component(): Testable
    {
        return Livewire::test(new class() extends Component
        {
            public $number = null;

            protected $rules = ['number' => 'required|integer|between:5,10'];

            protected $messages = [
                'number.required' => 'input cant be empty',
                'number.integer'  => 'input must be an integer',
                'number.between'  => 'input must be within the specified range',
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
                    <h1>Number Livewire Test</h1>

                    // test it_should_see_label_and_corner_description
                    <x-number label="Input 1" corner="Corner 1" />

                    // test it_should_see_description_and_not_see_prefix_and_suffix
                    <x-number
                        label="Input 1"
                        corner="Corner 1"
                        description="Description 1"
                        prefix="Prefix 1"
                        suffix="Suffix 1"
                    />

                    // test it_should_not_see_prepend_and_append_slots
                    <x-number>
                        <x-slot name="prepend">
                            <a>prepend</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append</a>
                        </x-slot>
                    </x-number>

                    // test it_should_not_see_prefix_suffix_append_and_prepend
                    <x-number prefix="prefix 2" suffix="suffix 2">
                        <x-slot name="prepend">
                            <a>prepend 2</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append 2</a>
                        </x-slot>
                    </x-number>

                    // test it_should_see_input_error
                    <x-number wire:model.live="number" label="Model Input" />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_see_label_and_corner_description(): void
    {
        $this->component()
            ->assertSee('Input 1')
            ->assertSee('Corner 1');
    }

    public function test_it_should_see_description_and_not_see_prefix_and_suffix(): void
    {
        $this->component()
            ->assertDontSee('Prefix 1')
            ->assertDontSee('Suffix 1')
            ->assertSee('Description 1');
    }

    public function test_it_should_not_see_prepend_and_append_slots(): void
    {
        $this->component()
            ->assertDontSeeHtml('<a>prepend</a>')
            ->assertDontSeeHtml('<a>append</a>');
    }

    public function test_it_should_not_see_prefix_suffix_append_and_prepend(): void
    {
        $this->component()
            ->assertDontSee('prefix 2')
            ->assertDontSee('suffix 2')
            ->assertDontSeeHtml('<a>prepend 2</a>')
            ->assertDontSeeHtml('<a>append 2</a>');
    }

    public function test_it_should_see_input_error(): void
    {
        $this->component()
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

    public function test_it_should_set_model_value_to_livewire(): void
    {
        $this->browser()
            ->type('number', 8)
            ->waitForTextIn('@number-value', 8);
    }

    public function test_it_should_change_the_input_value_when_clicking_on_the_plus_or_minus_icon(): void
    {
        $this->browser()
            ->assertSee('Show Number')
            ->assertInputValue('show-number', '')
            ->type('show-number', 2)
            ->doubleClick('div[wire\\:key="show-number"] > label > div[name="form.wrapper.container.append"] > button')
            ->assertInputValue('show-number', '4')
            ->click('div[wire\\:key="show-number"] > label > div[name="form.wrapper.container.prepend"] > button')
            ->assertInputValue('show-number', '3');
    }
}
