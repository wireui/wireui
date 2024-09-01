<?php

namespace WireUi\Components\TextField\tests\Browser;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class InputTest extends BrowserTestCase
{
    public function test_it_should_see_label_and_corner(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-input label="Input 1" corner="Corner 1" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Input 1')
            ->assertSee('Corner 1');
    }

    public function test_it_should_see_description_prefix_and_suffix(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-input label="Input 1" corner="Corner 1" prefix="Prefix 1" suffix="Suffix 1" description="Description 1" />
                </div>
                BLADE;
            }
        })
            ->assertSee('Prefix 1')
            ->assertSee('Suffix 1')
            ->assertSee('Description 1');
    }

    public function test_it_should_see_append_and_prepend_slots(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-input>
                        <x-slot name="prepend">
                            <a>prepend</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append</a>
                        </x-slot>
                    </x-input>
                </div>
                BLADE;
            }
        })
            ->assertSeeHtml('<a>prepend</a>')
            ->assertSeeHtml('<a>append</a>');
    }

    public function test_it_should_see_prefix_and_suffix_instead_append_or_prepend_slots(): void
    {
        Livewire::test(new class extends Component
        {
            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-input prefix="prefix 2" suffix="suffix 2">
                        <x-slot name="prepend">
                            <a>prepend 2</a>
                        </x-slot>

                        <x-slot name="append">
                            <a>append 2</a>
                        </x-slot>
                    </x-input>
                </div>
                BLADE;
            }
        })
            ->assertDontSee('prefix 2')
            ->assertDontSee('suffix 2')
            ->assertSeeHtml('<a>prepend 2</a>')
            ->assertSeeHtml('<a>append 2</a>');
    }

    public function test_it_should_see_input_error(): void
    {
        Livewire::test(new class extends Component
        {
            #[Validate('required', message: 'input is required')]
            public $model = null;

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
                    <x-input wire:model.live="model" label="Model Input" />
                </div>
                BLADE;
            }
        })
            ->call('save')
            ->assertSee('input is required')
            ->call('clear')
            ->assertDontSee('input is required');
    }

    public function test_it_should_dont_see_the_input_error_message(): void
    {
        Livewire::test(new class extends Component
        {
            #[Validate('required', message: 'input is required')]
            public $model = null;

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
                    <x-input wire:model.live="model" label="Test error less" :errorless="true" />
                </div>
                BLADE;
            }
        })
            ->call('save')
            ->assertDontSee('input is required')
            ->assertHasErrors('model');
    }

    public function test_it_should_set_model_value_to_livewire(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$model" />

                    <x-input wire:model.live="model" label="Model Input" />
                </div>
                BLADE;
            }
        })
            ->type('model', 'wireui@livewire-wireui.com')
            ->waitForTextIn('@value', 'wireui@livewire-wireui.com');
    }
}
