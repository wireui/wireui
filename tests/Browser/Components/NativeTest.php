<?php

namespace Tests\Browser\Components;

use Laravel\Dusk\Browser;
use Livewire\{Component, Livewire};
use Tests\Browser\BrowserTestCase;

class NativeTest extends BrowserTestCase
{
    public function component(): Browser
    {
        return Livewire::visit(new class() extends Component
        {
            public $model = null;

            public $arrayOptionsModel = null;

            public $collectionOptions = null;

            public $collectionOptionsModel = null;

            public $arrayWithLabelAndValueKeys = null;

            public $options = [
                'Array Option 1',
                'Array Option 2',
                'Array Option 3',
            ];

            public $labelOptions = [
                ['label' => 'Label Option 1', 'value' => 1],
                ['label' => 'Label Option 2', 'value' => 2],
                ['label' => 'Label Option 3', 'value' => 3],
            ];

            protected $rules = [
                'model' => 'required',
            ];

            protected $messages = [
                'model.required' => 'select a value',
            ];

            public function mount()
            {
                $this->collectionOptions = collect([
                    'Collection Option 1',
                    'Collection Option 2',
                    'Collection Option 3',
                ]);
            }

            public function validateSelect()
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
                    <h1>Native Select test</h1>

                    <span dusk="value">{{ $model }}</span>

                    <button dusk="validate" wire:click="validateSelect">validate</button>

                    // test it_should_render_select_with_slot_options_and_show_error_message
                    <x-native-select placeholder="Select a value" label="Select" wire:model.live="model">
                        <option value="">default</option>
                        <option>Slot Option 1</option>
                        <option>Slot Option 2</option>
                        <option>Slot Option 3</option>
                    </x-native-select>

                    // test it_should_render_select_with_give_collection_options
                    <x-native-select label="Label" wire:model.live="arrayOptionsModel" :options="$options" />

                    // test it_should_render_select_with_give_array_options
                    <x-native-select label="Label" wire:model.live="collectionOptionsModel" :options="$collectionOptions"  />

                    // test it_should_render_select_with_give_array_options_with_label_and_option_keys
                    <x-native-select
                        label="Label"
                        wire:model.live="arrayWithLabelAndValueKeys"
                        option-label="label"
                        option-value="value"
                        :options="$labelOptions"
                    />

                    // test it_should_render_select_with_give_array_options_using_key_as_value
                    <x-native-select
                        name="option-key-value"
                        option-key-value
                        :options="$options"
                    />

                    // test it_should_render_select_with_give_array_options_using_key_as_label
                    <x-native-select
                        name="option-key-label"
                        option-key-label
                        :options="$options"
                    />
                </div>
                BLADE;
            }
        });
    }

    public function test_it_should_render_select_with_slot_options_and_show_error_message()
    {
        $this->component()
            ->assertSelectHasOptions('model', ['Slot Option 1', 'Slot Option 2', 'Slot Option 3'])
            ->select('model', 'Slot Option 2')
            ->assertSelected('model', 'Slot Option 2')
            ->waitForTextIn('@value', 'Slot Option 2')
            ->select('model', '')
            ->assertSelected('model', '')
            ->click('@validate')
            ->waitTo(fn (Browser $browser) => $browser->assertSeeNothingIn('@value'))
            ->waitForText('select a value')
            ->assertSee('select a value');
    }

    public function test_it_should_render_select_with_give_array_options()
    {
        $this->component()->assertSelectHasOptions(
            'arrayOptionsModel',
            [
                'Array Option 1',
                'Array Option 2',
                'Array Option 3',
            ],
        );
    }

    public function test_it_should_render_select_with_give_collection_options()
    {
        $this->component()->assertSelectHasOptions(
            'collectionOptionsModel',
            collect([
                'Collection Option 1',
                'Collection Option 2',
                'Collection Option 3',
            ])->values()->toArray(),
        );
    }

    public function test_it_should_render_select_with_give_array_options_with_label_and_option_keys()
    {
        $this->component()->assertSelectHasOptions(
            'arrayWithLabelAndValueKeys',
            [
                'Label Option 1' => 1,
                'Label Option 2' => 2,
                'Label Option 3' => 3,
            ],
        );
    }

    public function test_it_should_render_select_with_give_array_options_using_key_as_value()
    {
        $this->component()->assertSelectHasOptions(
            'option-key-value',
            [
                'Array Option 1' => 0,
                'Array Option 2' => 1,
                'Array Option 3' => 2,
            ],
        );
    }

    public function test_it_should_render_select_with_give_array_options_using_key_as_label()
    {
        $this->component()->assertSelectHasOptions(
            'option-key-label',
            [
                0 => 'Array Option 1',
                1 => 'Array Option 2',
                2 => 'Array Option 3',
            ],
        );
    }
}
