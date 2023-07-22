<x-docs-scope :page="$page">
    {{-- Summary --}}
    <x-docs::summary>
        <x-docs::summary.header href="#datetime-picker" label="Datetime Picker">
            <x-docs::summary.item href="#default" label="Default Datetime Picker" />
            <x-docs::summary.item href="#custom-format" label="Custom Datetime Format" />
            <x-docs::summary.item href="#display-format" label="Custom Display Format" />
            <x-docs::summary.item href="#without-timezone" label="Without Timezone" />
            <x-docs::summary.item href="#min-max-dates" label="Min & Max dates" />
            <x-docs::summary.item href="#min-max-times" label="Min & Max times" />
        </x-docs::summary.header>

        <x-docs::summary.header href="#datetime-picker-options" label="Datetime Picker Options" />

        <x-docs::summary.header href="#playground" label="Playground" />
    </x-docs::summary>

    {{-- Section --}}
    <x-docs::title id="datetime-picker" title="Datetime Picker" />

    <x-docs::text>
        The Datetime Picker component is able to change date and time using timezones or ignoring timezone diff.
        You can use automatic timezone or set a custom timezone to System Timezone or User Timezone.
    </x-docs::text>

    <x-docs::subtitle id="default" title="Default Datetime Picker" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-md px-4 mx-auto sm:px-16">
            @verbatim
                <span class="dark:text-gray-400">Model: {{ $normalPicker }}</span>

                <x-datetime-picker
                    id="normalPicker"
                    label="Appointment Date"
                    placeholder="Appointment Date"
                    wire:model="normalPicker"
                />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="custom-format" title="Custom Datetime Format" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm px-4 mx-auto sm:px-16">
            @verbatim
                <span class="dark:text-gray-400">Model: {{ $customFormat }}</span>

                <x-datetime-picker
                    id="customFormat"
                    label="Appointment Date"
                    placeholder="Appointment Date"
                    parse-format="DD-MM-YYYY HH:mm"
                    wire:model="customFormat"
                />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="display-format" title="Custom Display Format" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm px-4 mx-auto sm:px-16">
            @verbatim
                <span class="dark:text-gray-400">Model: {{ $displayFormat }}</span>

                <x-datetime-picker
                    id="displayFormat"
                    label="Appointment Date"
                    placeholder="Appointment Date"
                    display-format="DD-MM-YYYY HH:mm"
                    wire:model="displayFormat"
                />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="without-timezone" title="Without Timezone" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm px-4 mx-auto sm:px-16">
            @verbatim
                <span class="dark:text-gray-400">Model: {{ $withoutTimezone }}</span>

                <x-datetime-picker
                    id="withoutTimezone"
                    without-timezone
                    label="Appointment Date"
                    placeholder="Appointment Date"
                    wire:model="withoutTimezone"
                />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="min-max-dates" title="Min & Max dates" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm px-4 mx-auto sm:px-16">
            @verbatim
                <ul class="mb-2 dark:text-gray-400">
                    <li>
                        <b>System Time:</b> {{ now() }} {{ now()->timezoneName }}
                    </li>

                    <li>
                        <b>Min date:</b> now() - 7 days, 12:30 PM
                    </li>

                    <li>
                        <b>Max date:</b> now() + 7 days, 12:30 PM
                    </li>

                    <li>
                        <b>Model:</b> {{ $mixAndMaxDates }}
                    </li>
                </ul>

                <x-datetime-picker
                    id="min-max-dates-input"
                    without-timezone
                    label="Appointment Date"
                    placeholder="Appointment Date"
                    wire:model="mixAndMaxDates"
                    :min="now()->subDays(7)->hours(12)->minutes(30)"
                    :max="now()->addDays(7)->hours(12)->minutes(30)"
                />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    <x-docs::subtitle id="min-max-times" title="Min & Max times" />

    <x-docs::code.preview language="blade">
        <x-slot name="slot" class="max-w-sm px-4 mx-auto sm:px-16">
            @verbatim
                <x-datetime-picker
                    id="min-max-times-input"
                    without-timezone
                    label="Appointment Date"
                    placeholder="Appointment Date"
                    wire:model.defer="mixAndMaxTimes"
                    min-time="08:00"
                    max-time="18:00"
                />
            @endverbatim
        </x-slot>
    </x-docs::code.preview>

    {{-- Section --}}
    <x-docs::title id="datetime-picker-options" title="Datetime Picker Options" />

    <x-docs::text>
        The datetime picker accepts all
        <x-link href="{{ route('docs.index', 'inputs') }}#input-options">input</x-link>
        options and slots.
    </x-docs::text>

    <x-docs::table>
        <x-docs::table.row prop="clearable" required="false" default="true" type="boolean" available="boolean" />
        <x-docs::table.row prop="without-tips" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="without-timezone" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="without-time" required="false" default="false" type="boolean" available="boolean" />
        <x-docs::table.row prop="interval" required="false" default="10" type="string|number" available="boolean" />
        <x-docs::table.row prop="time-format" required="false" default="12" type="string" available="12|24" />
        <x-docs::table.row prop="timezone" required="false" default="UTC" type="string" available="All js available timezones" />
        <x-docs::table.row prop="user-timezone" required="false" default="real user timezone" type="string" available="All js available timezones" />
        <x-docs::table.row prop="parse-format" required="false" default="ISO8601" type="string" available="All dayjs formats" />
        <x-docs::table.row prop="display-format" required="false" default="localeFormat" type="string" available="All dayjs formats" />
        <x-docs::table.row prop="min" required="false" default="null" type="Carbon|DateTimeInterface|string|timestamp|null" available="All Suported Carbon::parse dates" />
        <x-docs::table.row prop="max" required="false" default="null" type="Carbon|DateTimeInterface|string|timestamp|null" available="All Suported Carbon::parse dates" />
    </x-docs::table>

    <x-docs::text>
        Read more about
        <x-link href="https://day.js.org/docs/en/display/format" target="_blank">Day.js</x-link>
        formats.
    </x-docs::text>

    {{-- Playground --}}
    {{-- @livewire('playground.datetime-picker') --}}
</x-docs-scope>
