<?php

use function Livewire\Volt\{state};

state(['singleMask' => '1234', 'multipleMask' => null, 'singleFormattedMask' => null]);

?>

<div>
    <h1>Maskable Input test</h1>

    // test it_should_start_input_with_formatted_value
    <span dusk="singleMaskValue">{{ $singleMask }}</span>
    <x-input-maskable
        label="Maskable"
        mask="##.##"
        wire:model.live="singleMask"
    />

    // test it_should_type_input_value_and_emit_formatted_value
    <span dusk="singleFormattedMaskValue">{{ $singleFormattedMask }}</span>
    <x-input-maskable
        label="Maskable"
        mask="##.##.SS"
        wire:model.live="singleFormattedMask"
        emit-formatted
    />

    // test it_should_type_input_value_and_apply_multiples_masks
    <span dusk="multipleMaskValue">{{ $multipleMask }}</span>
    <x-input-maskable
        label="Maskable"
        mask="['##.##', '##.##.##', '##.##.###']"
        wire:model.live="multipleMask"
        emit-formatted
    />
</div>
