<?php

use function Livewire\Volt\{state, mount, rules};

state([
    'model' => null,
    'model2' => null,
    'model3' => [],
    'model4' => null,
    'model5' => null,
    'asyncModel' => null,
    'collectionOptions' => null,
    'asyncModelNestedData' => null,
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
    'disableOptions' => [
        ['label' => 'Disabled Option 1', 'value' => 'disabled', 'disabled' => true],
        ['label' => 'Readonly Option 2', 'value' => 'readonly', 'readonly' => true],
        ['label' => 'Normal Option 3', 'value' => 'normal'],
    ],
]);

rules(['model' => 'required'])->messages([
    'model.required' => 'Select any value',
]);

mount(function (){
    $this->collectionOptions = collect([
        ['label' => 'Option A', 'value' => 'A'],
        ['label' => 'Option B', 'value' => 'B'],
        ['label' => 'Option C', 'value' => 'C'],
    ]);
});

$validateSelect = fn() => $this->validate();

$resetInputValidation = fn() => $this->resetValidation();

?>

<div>
    <h1>Select test</h1>

    <span dusk="model">{{ $model }}</span>
    <span dusk="model2">{{ $model2 }}</span>
    <span dusk="model3">{{ implode(',', $model3) }}</span>
    <span dusk="model4">{{ $model4 }}</span>
    <span dusk="model5">{{ $model5 }}</span>
    <span dusk="asyncModel">{{ $asyncModel }}</span>

    <button dusk="validate" wire:click="validateSelect">validate</button>

    // test it_should_show_validation_message
    // test it_should_select_one_option_from_simples_options_list
    <x-select
        :options="$options"
        placeholder="Select Single Value"
        label="Single Select"
        wire:model.live="model"
    />

    // test it_should_select_one_option_from_labeled_options_list
    <x-select
        :options="$labelOptions"
        placeholder="Select Single Value"
        label="Single Select"
        wire:model.live="model2"
        option-label="label"
        option-value="value"
    />

    // test it_should_select_and_unselect_multiples_options
    <x-select
        :options="$collectionOptions"
        placeholder="Select Multiples Values"
        multiselect
        label="Multiple Select"
        wire:model.live="model3"
        option-label="label"
        option-value="value"
    />

    // test it_should_select_from_slot_list
    <x-select
        placeholder="Slot Select"
        label="Slot Select"
        wire:model.live="model4"
    >
        <x-select.option label="Option D" value="D" />
        <x-select.option label="Option E" value="E" />
        <x-select.option label="Option F" value="F" />
    </x-select>

    // test it_should_cannot_select_readonly_and_disabled_options
    <x-select
        :options="$disableOptions"
        placeholder="Select With Readonly/Disabled"
        label="Select With Readonly/Disabled"
        wire:model.live="model5"
        option-label="label"
        option-value="value"
    />

    // test it_should_load_and_search_options_from_the_api
    <x-select
        label="Select From Async data"
        {{-- async-data="/api/options" --}}
        :async-data="route('api.options')"
        wire:model.live="asyncModel"
        option-value="id"
        option-label="name"
        wire:key="asyncModel"
    />

    // test it_should_load_from_the_api_with_nested_data
    <x-select
        label="Select From Async data"
        {{-- async-data="/api/options" --}}
        :async-data="['api' => route('api.options.nested'), 'optionsPath' => 'data.nested']"
        wire:model.live="asyncModelNestedData"
        option-value="id"
        option-label="name"
        wire:key="asyncModelNestedData"
    />
</div>
