<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#time-picker" label="Time Picker">
            <x-docs::summary.item href="#am-pm" label="AM/PM Time Picker" />
            <x-docs::summary.item href="#24-hours" label="24H Time Picker" />
            <x-docs::summary.item href="#custom-interval" label="Custom Interval" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#time-picker-options" label="Time Picker Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="time-picker" title="Time Picker" />

    <x-docs::text>
        The Time Picker component is able to change time in datetime, or change only time.
    </x-docs::text>

    <x-alert class="my-4" warning>
        <x-slot name="title">
            If you are using a model property bind <b>(wire:model="appointment.datetime")</b>
            as datetime, you must set model as <b>.defer</b> because datetime <b>cannot have empty time</b>,
            and automatically set 00:00 to time
        </x-slot>
    </x-alert>

    <x-docs::subtitle id="am-pm" title="AM/PM Time Picker" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm px-4 mx-auto sm:px-16">
            @verbatim
                <x-time-picker id="am-pm-time" label="AM/PM" placeholder="12:00 AM" wire:model.defer="timePicker" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="24-hours" title="24H Time Picker" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm px-4 mx-auto sm:px-16">
            @verbatim
                <x-time-picker id="24-hours" label="24 Hours" placeholder="22:30" format="24"
                    wire:model.defer="timePicker" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="custom-interval" title="Custom Interval" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm px-4 mx-auto sm:px-16">
            @verbatim
                <x-time-picker id="interval" label="AM/PM" placeholder="12:00 AM" interval="30"
                    wire:model.defer="timePicker" />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="time-picker-options" title="Time Picker Options" />

    <x-docs::table>
        <x-docs::table.row prop="interval" required="false" default="10" type="string|number" available="--" />
        <x-docs::table.row prop="format" required="false" default="12" type="string" available="12|24" />
    </x-docs::table>

    {{-- Playground --}}
    {{-- @livewire('playground.time-picker') --}}
</x-docs-scope>
