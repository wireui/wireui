<?php

use function Livewire\Volt\{state, rules};

state(['number' => null]);

rules(['number' => 'required|integer|between:5,10'])->messages([
    'number.required' => 'input cant be empty',
    'number.integer'  => 'input must be an integer',
    'number.between'  => 'input must be within the specified range',
]);

$validateInput = fn() => $this->validate();

$resetInputValidation = fn() => $this->resetValidation();

?>

<div>
    <h1>Number Input test</h1>

    // test it_should_see_label_and_corner_hint
    <x-input-number label="Input 1" corner-hint="Corner 1" />

    // test it_should_see_hint_and_not_see_prefix_and_suffix
    <x-input-number
        label="Input 1"
        corner-hint="Corner 1"
        hint="Hint 1"
        prefix="Prefix 1"
        suffix="Suffix 1"
    />

    // test it_should_not_see_prepend_and_append_slots
    <x-input-number>
        <x-slot name="prepend">
            <a>prepend</a>
        </x-slot>

        <x-slot name="append">
            <a>append</a>
        </x-slot>
    </x-input-number>

    // test it_should_not_see_prefix_suffix_append_and_prepend
    <x-input-number prefix="prefix 2" suffix="suffix 2">
        <x-slot name="prepend">
            <a>prepend 2</a>
        </x-slot>

        <x-slot name="append">
            <a>append 2</a>
        </x-slot>
    </x-input-number>

    // test it_should_set_model_value_to_livewire
    <x-input-number dusk="input" wire:model.live="number" label="Model Input" />
    <span dusk="number-value">{{ $number }}</span>

    // test it_should_change_the_input_value_when_clicking_on_the_plus_or_minus_icon
    <x-input-number wire:key="show-number" name="show-number" label="Show Number" />
</div>
