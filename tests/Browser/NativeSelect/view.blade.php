<?php

use function Livewire\Volt\{state, mount, rules};

state([
    'model' => null,
    'arrayOptionsModel' => null,
    'collectionOptions' => null,
    'collectionOptionsModel' => null,
    'arrayWithLabelAndValueKeys' => null,
    'options' => [
        'Array Option 1',
        'Array Option 2',
        'Array Option 3',
    ],
    'labelOptions' => [
        ['label' => 'Label Option 1', 'value' => 1],
        ['label' => 'Label Option 2', 'value' => 2],
        ['label' => 'Label Option 3', 'value' => 3],
    ],
]);

rules(['model' => 'required'])->messages([
    'model.required' => 'select a value',
]);

mount(function (){
    $this->collectionOptions = collect([
        'Collection Option 1',
        'Collection Option 2',
        'Collection Option 3',
    ]);
});

$validateSelect = fn() => $this->validate();

$resetInputValidation = fn() => $this->resetValidation();

?>

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
