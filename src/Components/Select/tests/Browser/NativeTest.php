<?php

namespace WireUi\Components\Select\tests\Browser;

use Laravel\Dusk\Browser;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Livewire;
use Tests\Browser\BrowserTestCase;

class NativeTest extends BrowserTestCase
{
    public function test_it_should_render_select_with_slot_options_and_show_error_message(): void
    {
        Livewire::visit(new class extends Component
        {
            #[Validate('required', message: 'select a value')]
            public $model = null;

            public function save(): void
            {
                $this->validate();
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-badge dusk="value" :label="$model" />

                    <x-button dusk="validate" wire:click="save" label="Validate" />

                    <x-native-select wire:model.live="model" label="Select" placeholder="Select a value">
                        <option value="">default</option>
                        <option>Slot Option 1</option>
                        <option>Slot Option 2</option>
                        <option>Slot Option 3</option>
                    </x-native-select>
                </div>
                BLADE;
            }
        })
            ->assertSelectHasOptions('model', ['Slot Option 1', 'Slot Option 2', 'Slot Option 3'])
            ->select('model', 'Slot Option 2')
            ->assertSelected('model', 'Slot Option 2')
            ->waitForTextIn('@value', 'Slot Option 2')
            ->select('model', '')
            ->assertSelected('model', '')
            ->click('@validate')
            ->waitTo(fn (Browser $browser) => $browser->assertSeeNothingIn('@value'))
            ->waitForText('select a value')->assertSee('select a value');
    }

    public function test_it_should_render_select_with_give_array_options(): void
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
                    <x-native-select
                        wire:model.live="model"
                        label="Label"
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        })->assertSelectHasOptions(
            'model',
            [
                'Array Option 1',
                'Array Option 2',
                'Array Option 3',
            ],
        );
    }

    public function test_it_should_render_select_with_give_collection_options(): void
    {
        Livewire::visit(new class extends Component
        {
            public $model = null;

            public $options = null;

            public function mount(): void
            {
                $this->options = collect([
                    'Collection Option 1',
                    'Collection Option 2',
                    'Collection Option 3',
                ]);
            }

            public function render(): string
            {
                return <<<'BLADE'
                <div>
                    <x-native-select
                        wire:model.live="model"
                        label="Label"
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        })->assertSelectHasOptions(
            'model',
            collect([
                'Collection Option 1',
                'Collection Option 2',
                'Collection Option 3',
            ])->values()->toArray(),
        );
    }

    public function test_it_should_render_select_with_give_array_options_with_label_and_option_keys(): void
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
                    <x-native-select
                        wire:model.live="model"
                        label="Label"
                        option-label="label"
                        option-value="value"
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        })->assertSelectHasOptions(
            'model',
            [
                'Label Option 1' => 1,
                'Label Option 2' => 2,
                'Label Option 3' => 3,
            ],
        );
    }

    public function test_it_should_render_select_with_give_array_options_using_key_as_value(): void
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
                    <x-native-select
                        wire:model.live="model"
                        label="Label"
                        option-key-value
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        })->assertSelectHasOptions(
            'model',
            [
                'Array Option 1' => 0,
                'Array Option 2' => 1,
                'Array Option 3' => 2,
            ],
        );
    }

    public function test_it_should_render_select_with_give_array_options_using_key_as_label(): void
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
                    <x-native-select
                        wire:model.live="model"
                        label="Label"
                        option-key-label
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        })->assertSelectHasOptions(
            'model',
            [
                0 => 'Array Option 1',
                1 => 'Array Option 2',
                2 => 'Array Option 3',
            ],
        );
    }
}
