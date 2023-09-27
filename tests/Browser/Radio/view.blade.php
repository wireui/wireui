<?php

use function Livewire\Volt\{state, rules};

state(['radio' => null]);

rules(['radio' => 'required'])->messages([
    'radio.required' => 'select one',
]);

$validateRadio = fn() => $this->validate();

?>

<div>
    <h1>Radio Test</h1>

    <span dusk="radio">@json($radio)</span>

    // test it_should_render_with_label_and_change_value
    <x-radio id="laravel"  value="Laravel"  label="Laravel"  wire:model.live="radio" />
    <x-radio id="livewire" value="Livewire" label="Livewire" wire:model.live="radio" />

    <button wire:click="validateRadio" dusk="validate">validate</button>
</div>
