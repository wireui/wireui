<?php

use function Livewire\Volt\{state, mount};
use Illuminate\Support\Carbon;

state(['date' => null, 'model' => '2021-12-15 10:30']);

mount(function () {
    $this->date = Carbon::parse('2021-12-15 10:30');
});

?>

<div>
    <span dusk="value">{{ $model }}</span>

    <x-datetime-picker
        wire:model.live="model"
        without-timezone
        :min="$date->copy()->subDays(7)->setHour(12)->toISOString()"
        :max="$date->copy()->addDays(7)->setHour(15)->toISOString()"
    />
</div>
