<?php

use function Livewire\Volt\{state, rules};

state(['blur' => '#00000', 'live' => '#001', 'throttle' => '#00000']);

?>

<div>
    <h1>BlurTest</h1>
    <span dusk="blur">{{ $blur }}</span>

    <x-color-picker wire:model.blur="blur" />

    <h1>ThrottleTest</h1>
    <span dusk="throttle">{{ $throttle }}</span>

    <x-color-picker wire:model.live.throttle.500ms="throttle" />

    <h1>LiveTest</h1>
    <div id="color-picker">
        <x-color-picker name="color-picker" value="#123" />
    </div>

    <div id="color-picker-wire">
        <x-color-picker name="color-picker-wire" wire:model.live="live" />
    </div>

    <div id="colors">
        <x-color-picker name="colors" :colors="['#123', '#456']" />
    </div>

    <div id="named-colors">
        <x-color-picker name="named-colors" :colors="[['name'=>'FFF', 'value'=>'#FFF']]" />
    </div>
</div>
