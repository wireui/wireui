<?php

use function Livewire\Volt\{state, rules};

state(['color' => '#00000']);

?>

<div>
    <span dusk="model">{{ $color }}</span>

    <x-color-picker wire:model.live.throttle.500ms="color" />
</div>
