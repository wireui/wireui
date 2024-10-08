<?php

namespace WireUi\Components\TextField\tests\Browser;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class NumberTest extends BrowserTestCase
{
    public function test_it_should_see_label_and_corner_description(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-number label="Input 1" corner="Corner 1" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Input 1')
            ->assertSee('Corner 1');
    }

    public function test_it_should_see_description_and_not_see_prefix_and_suffix(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-number
                        label="Input 1"
                        corner="Corner 1"
                        description="Description 1"
                        prefix="Prefix 1"
                        suffix="Suffix 1"
                    />
                </div>
                BLADE;
            }
        })
            ->assertDontSee('Prefix 1')
            ->assertDontSee('Suffix 1')
            ->assertSee('Description 1');
    }

    public function test_it_should_not_see_prepend_and_append_slots(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-number>
                        <x-slot name="prepend">
                            <a>prepend</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append</a>
                        </x-slot>
                    </x-number>
                </div>
                BLADE;
            }
        })
            ->assertDontSeeHtml('<a>prepend</a>')
            ->assertDontSeeHtml('<a>append</a>');
    }

    public function test_it_should_not_see_prefix_suffix_append_and_prepend(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-number prefix="prefix 2" suffix="suffix 2">
                        <x-slot name="prepend">
                            <a>prepend 2</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append 2</a>
                        </x-slot>
                    </x-number>
                </div>
                BLADE;
            }
        })
            ->assertDontSee('prefix 2')
            ->assertDontSee('suffix 2')
            ->assertDontSeeHtml('<a>prepend 2</a>')
            ->assertDontSeeHtml('<a>append 2</a>');
    }

    public function test_it_should_see_input_error(): void
    {
        Livewire::test(new class extends Component
        {
            #[Validate('required', message: 'input cant be empty')]
            #[Validate('integer', message: 'input must be an integer')]
            #[Validate('between:5,10', message: 'input must be within the specified range')]
            public $number = null;

            public function save(): void
            {
                $this->validate();
            }

            public function clear(): void
            {
                $this->resetValidation();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-number wire:model.live="number" label="Model Input" />
                </div>
                BLADE;
            }
        })
            ->call('save')
            ->assertSee('input cant be empty')
            ->set('number', 'text')
            ->call('save')
            ->assertSee('input must be an integer')
            ->set('number', 11)
            ->call('save')
            ->assertSee('input must be within the specified range')
            ->call('clear')
            ->assertDontSee('input cant be empty')
            ->assertDontSee('input must be an integer')
            ->assertDontSee('input must be within the specified range');
    }

    public function test_it_should_set_model_value_to_livewire(): void
    {
        Livewire::visit(new class extends Component
        {
            public $number = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$number" />

                    <x-number wire:model.live="number" label="Model Input" />
                </div>
                BLADE;
            }
        })
            ->type('number', 8)
            ->waitForTextIn('@value', 8);
    }

    public function test_it_should_change_the_input_value_when_clicking_on_the_plus_or_minus_icon(): void
    {
        Livewire::visit(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-number wire:key="number" name="number" label="Show Number" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Show Number')
            ->assertInputValue('number', '')
            ->type('number', 2)
            ->doubleClick('div[wire\\:key="number"] > label > div[name="form.wrapper.container.append"] > button')
            ->assertInputValue('number', '4')
            ->click('div[wire\\:key="number"] > label > div[name="form.wrapper.container.prepend"] > button')
            ->assertInputValue('number', '3');
    }

    public function test_it_use_html_attributes(): void
    {
        Livewire::visit(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-number wire:key="number" name="number" label="Show Number" min="5" max="7" step="0.5" value="6" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Show Number')
            ->assertInputValue('number', '6')
            ->type('number', 6)
            ->doubleClick('div[wire\\:key="number"] > label > div[name="form.wrapper.container.append"] > button')
            ->assertInputValue('number', '7')
            ->doubleClick('div[wire\\:key="number"] > label > div[name="form.wrapper.container.append"] > button')
            ->assertInputValue('number', '7')
            ->click('div[wire\\:key="number"] > label > div[name="form.wrapper.container.prepend"] > button')
            ->assertInputValue('number', '6.5');
    }
}
