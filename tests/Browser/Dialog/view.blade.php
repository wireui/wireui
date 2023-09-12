<?php

use function Livewire\Volt\{on, uses, state};
use WireUi\Traits\WireUiActions;

uses([WireUiActions::class]);

state(['events' => []]);

on(['showDialog' => function (array $options) {
    $this->dialog()->show($options);
}]);

on(['addEvent' => function (string $event) {
    $this->events[] = $event;
}]);

?>

<div>
    <h1>Dialog test</h1>

    <x-dialog id="custom">
        my slot
    </x-dialog>

    <span dusk="events">{{ implode(', ', $events) }}</span>
</div>
