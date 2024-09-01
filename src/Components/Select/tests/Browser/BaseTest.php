<?php

namespace WireUi\Components\Select\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class BaseTest extends BrowserTestCase
{
    public function test_it_should_show_validation_message(): void
    {
        Livewire::visit(new class extends Component
        {
            #[Validate('required', message: 'Select any value')]
            public $model = null;

            public $options = [
                'Array Option 1',
                'Array Option 2',
                'Array Option 3',
            ];

            public function save(): void
            {
                $this->validate();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-button dusk="validate" wire:click="save" label="Validate" />

                    <x-select
                        wire:model.live="model"
                        label="Single Select"
                        placeholder="Select Single Value"
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        })
            ->click('@validate')
            ->waitTo(fn (Browser $browser) => $browser->assertSee('Select any value'));
    }

    public function test_it_should_select_one_option_from_simples_options_list(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = null;

            public $options = [
                'Array Option 1',
                'Array Option 2',
                'Array Option 3',
            ];

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$model" />

                    <x-select
                        wire:model.live="model"
                        label="Single Select"
                        placeholder="Select Single Value"
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        })
            ->toggleSelect()
            ->waitForSelectOption('Array Option 2')
            ->wireUiSelectValue('model', 1)
            ->waitForTextIn('@value', 'Array Option 2')
            ->toggleSelect()
            ->waitForSelectOption('Array Option 1')
            ->wireUiSelectValue('model', 0)
            ->waitForTextIn('@value', 'Array Option 1');
    }

    public function test_it_should_select_one_option_from_labeled_options_list(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = null;

            public $options = [
                ['label' => 'Label Option 1', 'value' => 1],
                ['label' => 'Label Option 2', 'value' => 2],
                ['label' => 'Label Option 3', 'value' => 3],
            ];

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$model" />

                    <x-select
                        wire:model.live="model"
                        label="Single Select"
                        placeholder="Select Single Value"
                        option-label="label"
                        option-value="value"
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        })
            ->toggleSelect()
            ->waitForSelectOption('Label Option 2')
            ->wireUiSelectValue('model', 1)
            ->waitForTextIn('@value', '2')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', '2'))
            ->toggleSelect()
            ->waitForSelectOption('Label Option 1')
            ->wireUiSelectValue('model', 0)
            ->waitForTextIn('@value', '1')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', '1'));
    }

    public function test_it_should_select_and_unselect_multiples_options(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = [];

            public $options = null;

            public function mount(): void
            {
                $this->options = collect([
                    ['label' => 'Option A', 'value' => 'A'],
                    ['label' => 'Option B', 'value' => 'B'],
                    ['label' => 'Option C', 'value' => 'C'],
                ]);
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="implode(',', $model)" />

                    <x-select
                        wire:model.live="model"
                        label="Multiple Select"
                        placeholder="Select Multiples Values"
                        option-label="label"
                        option-value="value"
                        :options="$options"
                        multiselect
                    />
                </div>
                BLADE;
            }
        })
            ->toggleSelect()
            ->waitForSelectOption('Option A')
            ->wireUiSelectValue('model', 0)
            ->waitForTextIn('@value', 'A')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', '["A"]'))
            ->wireUiSelectValue('model', 1)
            ->waitForTextIn('@value', 'A,B')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', '["A","B"]'))
            ->wireUiSelectValue('model', 0)
            ->waitForTextIn('@value', 'B')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', '["B"]'));
    }

    public function test_it_should_select_from_slot_list(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$model" />

                    <x-select
                        wire:model.live="model"
                        label="Slot Select"
                        placeholder="Slot Select"
                    >
                        <x-select.option label="Option D" value="D" />
                        <x-select.option label="Option E" value="E" />
                        <x-select.option label="Option F" value="F" />
                    </x-select>
                </div>
                BLADE;
            }
        })
            ->toggleSelect()
            ->waitForSelectOption('Option E')
            ->wireUiSelectValue('model', 1)
            ->waitForTextIn('@value', 'E')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', 'E'))
            ->toggleSelect()
            ->waitForSelectOption('Option D')
            ->wireUiSelectValue('model', 0)
            ->waitForTextIn('@value', 'D')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', 'D'));
    }

    public function test_it_should_cannot_select_readonly_and_disabled_options(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = null;

            public $options = [
                ['label' => 'Disabled Option 1', 'value' => 'disabled', 'disabled' => true],
                ['label' => 'Readonly Option 2', 'value' => 'readonly', 'readonly' => true],
                ['label' => 'Normal Option 3', 'value' => 'normal'],
            ];

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$model" />

                    <x-select
                        wire:model.live="model"
                        label="Select With Readonly/Disabled"
                        placeholder="Select With Readonly/Disabled"
                        option-label="label"
                        option-value="value"
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        })
            ->toggleSelect()
            ->waitForSelectOption('Normal Option 3')
            ->wireUiSelectValue('model', 0)->assertSeeNothingIn('@value')
            ->wireUiSelectValue('model', 1)->assertSeeNothingIn('@value')
            ->wireUiSelectValue('model', 2)->waitForTextIn('@value', 'normal')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', 'normal'));
    }

    public function test_it_should_load_and_search_options_from_the_api(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$model" />

                    <x-select
                        wire:model.live="model"
                        label="Select From Async data"
                        placeholder="Select From Async data"
                        option-value="id"
                        option-label="name"
                        :async-data="route('api.options')"
                        {{-- async-data="/api/options" --}}
                    />
                </div>
                BLADE;
            }
        })
            ->toggleSelect()
            ->waitForSelectOption('Pedro')
            ->wireUiSelectValue('model', 0)
            ->waitForTextIn('@value', '1')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', '1'))
            ->toggleSelect()
            ->waitForSelectOption('Pedro')
            ->typeSlowly('input[x-ref="search"]', 'kei')
            ->pause(1000)
            ->waitForSelectOption('Keithy')
            ->wireUiSelectValue('model', 0)
            ->waitForTextIn('@value', '2')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', '2'));
    }

    public function test_it_should_load_from_the_api_with_nested_data(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = null;

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$model" />

                    <x-select
                        wire:model.live="model"
                        label="Select From Async data"
                        placeholder="Select From Async data"
                        option-value="id"
                        option-label="name"
                        {{-- async-data="/api/options" --}}
                        :async-data="['api' => route('api.options.nested'), 'optionsPath' => 'data.nested']"
                    />
                </div>
                BLADE;
            }
        })
            ->toggleSelect()
            ->waitForSelectOption('Tommy')
            ->wireUiSelectValue('model', 4)
            ->waitForTextIn('@value', '5')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', '5'))
            ->toggleSelect()
            ->waitForSelectOption('Andre')
            ->wireUiSelectValue('model', 3)
            ->waitForTextIn('@value', '4')
            ->waitTo(fn (Browser $browser) => $browser->assertInputValue('model', '4'));
    }
}
