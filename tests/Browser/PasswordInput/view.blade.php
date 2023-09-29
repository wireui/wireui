<?php

use function Livewire\Volt\{state, rules};

state(['password' => null]);

rules(['password' => 'required'])->messages([
    'password.required' => 'input cant be empty',
]);

$validateInput = fn() => $this->validate();

$resetInputValidation = fn() => $this->resetValidation();

?>

<div>
    <h1>Password Input test</h1>

    // test it_should_see_label_and_corner_hint
    <x-input-password label="Input 1" corner-hint="Corner 1" />

    // test it_should_see_hint_and_prefix_and_not_see_suffix
    <x-input-password
        label="Input 1"
        corner-hint="Corner 1"
        hint="Hint 1"
        prefix="Prefix 1"
        suffix="Suffix 1"
    />

    // test it_should_not_see_prepend_and_append_slots
    <x-input-password>
        <x-slot name="prepend">
            <a>prepend 1</a>
        </x-slot>

        <x-slot name="append">
            <a>append 1</a>
        </x-slot>
    </x-input-password>

    // test it_should_see_prefix_and_not_see_suffix_instead_append_or_prepend_slots
    <x-input-password prefix="prefix 2" suffix="suffix 2">
        <x-slot name="prepend">
            <a>prepend 2</a>
        </x-slot>

        <x-slot name="append">
            <a>append 2</a>
        </x-slot>
    </x-input-password>

    // test it_should_set_model_value_to_livewire
    <x-input-password dusk="input" wire:model.live="password" label="Model Input" />
    <span dusk="password-value">{{ $password }}</span>

    // test it_should_change_the_input_type_when_clicking_on_the_view_password_icon
    <x-input-password wire:key="show-password" name="show-password" label="Show Password" />
</div>
