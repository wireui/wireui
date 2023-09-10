<?php

use function Livewire\Volt\{state, rules};

state(['color' => '#001']);

?>

<div>
    <div id="color-picker">
        <x-color-picker name="color-picker" value="#123" />
    </div>

    <div id="color-picker-wire">
        <x-color-picker name="color-picker-wire" wire:model.live="color" />
    </div>

    <div id="colors">
        <x-color-picker name="colors" :colors="['#123', '#456']" />
    </div>

    <div id="named-colors">
        <x-color-picker name="named-colors" :colors="[['name'=>'FFF', 'value'=>'#FFF']]" />
    </div>
</div>
