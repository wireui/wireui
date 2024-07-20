<x-dynamic-component
    :component="WireUi::component('text-field')"
    x-ref="container"
    :config="$config"
    :attributes="$wrapper"
    x-data="wireui_date_picker"
    :x-props="WireUi::toJs([
        'config' => [
            'requiresConfirmation' => $requiresConfirmation,
            'readonly'             => $readonly,
            'disabled'             => $disabled,
        ],
        'timezone' => [
            'enabled' => $withoutTimezone === false,
            'server'  => $timezone,
            'user'    => $userTimezone,
        ],
        'calendar' => [
            'weekDays'      => trans('wireui::messages.date_picker.days'),
            'monthNames'    => trans('wireui::messages.date_picker.months'),
            'startOfWeek'   => $startOfWeek,
            'min'           => $min?->format('Y-m-d\TH:i'),
            'max'           => $max?->format('Y-m-d\TH:i'),
            'allowedDates'  => $allowedDates,
            'multiple'      => [
                'enabled' => $multiple,
                'max'     => $multipleMax,
            ],
            'disabled'      => [
                'years'     => $disabledYears,
                'months'    => $disabledMonths,
                'weekdays'  => $disabledWeekdays,
                'dates'     => $disabledDates,
                'pastDates' => $disablePastDates,
            ],
        ],
        'timePicker' => [
            'enabled'  => $withoutTime === false && $multiple === false,
            'interval' => $interval,
            'is12H'    => $timeFormat == '12',
            'min'      => $minTime,
            'max'      => $maxTime,
        ],
        'input' => [
            'parseFormat'   => $parseFormat,
            'displayFormat' => $displayFormat,
        ],
        'wireModel'   => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
        'alpineModel' => WireUi::alpineModel($attributes),
    ])"
    x-bind:class="{
        'ring-2 ring-primary-600': positionable.isOpen(),
    }"
    x-on:click="positionable.toggle()"
    x-on:keydown.enter.stop.prevent="positionable.toggle()"
    x-on:keydown.space.stop.prevent="positionable.toggle()"
    x-on:keydown.arrow-down.stop.prevent="positionable.open()"
    tabindex="0"
>
    <div class="hidden" hidden>
        <x-wireui-wrapper::hidden
            :id="$id"
            :name="$name"
            :value="$value"
            x-ref="rawInput"
            x-bind:value="selectedRawValue"
        />
    </div>

    @include('wireui-wrapper::components.slots', [
        'except' => ['prepend', 'append'],
    ])

    @if ($multiple)
        <div
            class="flex items-center w-full gap-1 overflow-x-auto cursor-pointer hide-scrollbar overscroll-x-contain"
            x-show="selectedDates.length > 0"
        >
            <template x-for="(date, index) in selectedDatesDisplay" wire:key="date">
                <button
                    class="
                        bg-slate-100 text-2xs px-1 py-0.5 rounded border border-slate-200
                        flex items-center transition-all ease-in-out duration-150 cursor-pointer
                        hover:bg-negative-100 hover:text-negative-600 hover:border-negative-200
                        focus:bg-negative-100 focus:text-negative-600 focus:border-negative-200
                        focus:ring-1 focus:ring-negative-500 focus:outline-none
                        appearance-none outline-none
                    "
                    type="button"
                    title="{{ __('wireui::messages.labels.remove') }}"
                    x-on:click.stop.prevent="removeSelectedDate(index)"
                >
                    <span x-text="date"></span>
                </button>
            </template>
        </div>
    @endif

    <x-wireui-wrapper::element
        readonly
        autocomplete="off"
        :attributes="$input"
        class="cursor-pointer"
        x-bind:value="display"
        x-show="selectedDates.length === 0"
    />

    @if (!$readonly && !$disabled)
        <x-slot:append class="flex items-center">
            @if ($clearable)
                <x-dynamic-component
                    :component="WireUi::component('icon')"
                    class="w-4 h-4 mr-2 text-gray-400 transition-colors duration-150 ease-in-out cursor-pointer hover:text-negative-500 invalidated:text-negative-600"
                    name="x-mark"
                    x-show="entangleable.isNotEmpty()"
                    x-on:click.stop.prevent="clear"
                    x-cloak
                />
            @endif

            <x-dynamic-component
                :component="WireUi::component('button')"
                class="h-full"
                :color="$color ?? 'primary'"
                :rounded="data_get($roundedClasses, 'append', '')"
                :disabled="$disabled"
                x-on:keydown.arrow-down.prevent="focusable.walk.to('down')"
                use-validation-colors
                flat
            >
                <x-dynamic-component
                    :component="WireUi::component('icon')"
                    :name="$rightIcon"
                    @class([
                        'w-4 h-4 group-focus:text-primary-700 text-gray-400 dark:text-gray-600',
                        'dark:group-hover:text-gray-500 dark:group-focus:text-primary-500',
                        'invalidated:text-negative-500 invalidated:group-hover:text-negative-500 invalidated:group-focus:text-negative-500',
                    ])
                />
            </x-dynamic-component>
        </x-slot:append>
    @endif

    <x-slot:after>
        <x-dynamic-component
            :component="WireUi::component('popover')"
            :margin="(bool) $label"
            class="overflow-hidden sm:w-72"
            root-class="justify-end sm:!w-72 ml-auto sm:w-full"
            x-ref="optionsContainer"
            tabindex="-1"
            x-on:keydown.tab.prevent="$event.shiftKey || focusable.next()?.focus()"
            x-on:keydown.shift.tab.prevent="focusable.previous()?.focus()"
            x-on:keydown.arrow-up.prevent="focusable.walk.to('up')"
            x-on:keydown.arrow-down.prevent="focusable.walk.to('down')"
            x-on:keydown.arrow-left.prevent="focusable.walk.to('left')"
            x-on:keydown.arrow-right.prevent="focusable.walk.to('right')"
        >
            <header
                class="p-2.5"
                :class="{
                    'bg-slate-100': tab === 'time-picker',
                }"
            >
                @isset($header)
                    <div {{ $header->attributes }}>
                        {{ $header }}
                    </div>
                @endisset

                <div x-show="tab !== 'time-picker'" class="flex items-center justify-between">
                    <div class="flex items-center w-full gap-x-2 text-secondary-600 dark:text-secondary-500">
                        <button
                            class="flex items-center gap-x-2 focus:outline-none focus:underline"
                            x-on:click="toggleTab('years-picker')"
                            type="button"
                        >
                            <span x-text="calendar.year"></span>

                            <x-dynamic-component
                                :component="WireUi::component('icon')"
                                class="transition-all duration-200 ease-in-out size-3"
                                x-bind:class="{ 'rotate-180': tab === 'years-picker' }"
                                name="chevron-down"
                                gray flat
                            />
                        </button>

                        <button
                            class="flex items-center gap-x-2 focus:outline-none focus:underline"
                            x-on:click="toggleTab('months-picker')"
                            type="button"
                        >
                            <span x-text="$props.calendar.monthNames[calendar.month]"></span>

                            <x-dynamic-component
                                :component="WireUi::component('icon')"
                                class="transition-all duration-200 ease-in-out size-3"
                                x-bind:class="{ 'rotate-180': tab === 'months-picker' }"
                                name="chevron-down"
                                gray flat
                            />
                        </button>
                    </div>

                    <div class="flex items-center">
                        <x-dynamic-component
                            :component="WireUi::component('mini-button')"
                            class="shrink-0"
                            x-on:click="previous"
                            icon="chevron-left"
                            gray flat rounded="lg"
                        />

                        <x-dynamic-component
                            :component="WireUi::component('mini-button')"
                            class="shrink-0"
                            x-on:click="goToday"
                            gray flat rounded
                        >
                            <div class="rounded-full size-2 bg-slate-600"></div>
                        </x-dynamic-component>

                        <x-dynamic-component
                            :component="WireUi::component('mini-button')"
                            class="shrink-0"
                            x-on:click="next"
                            icon="chevron-right"
                            gray flat rounded="lg"
                        />
                    </div>
                </div>

                <div x-show="tab === 'time-picker'" class="flex items-center justify-between">
                    <h3 class="font-medium text-slate-600">
                        Time Selection
                    </h3>

                    <x-dynamic-component
                        :component="WireUi::component('mini-button')"
                        icon="calendar-days"
                        flat gray rounded
                        x-on:click="toggleTab('calendar')"
                    />
                </div>

                @isset($headerAfter)
                    <div {{ $headerAfter->attributes }}>
                        {{ $headerAfter }}
                    </div>
                @endisset
            </header>

            <div class="p-2.5" :class="{ 'px-0': tab === 'time-picker' }">
                <template x-if="tab === 'months-picker'">
                    <div class="grid grid-cols-3 gap-2">
                        <template x-for="(name, index) in $props.calendar.monthNames" :key="`month.${name}`">
                            <button
                                class="px-2 py-4 text-xs text-gray-700 uppercase transition-all duration-150 ease-in-out border rounded-md outline-none border-primary-100 focus:ring-2 focus:ring-offset-2 disabled:cursor-not-allowed disabled:bg-slate-200 disabled:opacity-50 disabled:border-slate-200"
                                :class="{
                                    'text-white bg-primary-500 font-semibold focus:ring-primary-600': index === calendar.month,
                                    'hover:bg-primary-100 hover:text-primary-900 hover:font-medium': index !== calendar.month,
                                    'bg-primary-50 shadow-sm font-medium text-slate-600': index !== calendar.month,
                                    'focus:ring-primary-200 focus:bg-primary-100': index !== calendar.month,
                                }"
                                x-on:click="selectMonth(index)"
                                :disabled="$props.calendar.disabled.months.includes(index)"
                                x-text="name"
                            ></button>
                        </template>
                    </div>
                </template>

                <template x-if="tab === 'years-picker'">
                    <div class="grid grid-cols-3 gap-2">
                        <template x-for="year in calendar.years" :key="`month.${year.number}`">
                            <button
                                class="
                                    rounded-md p-2.5 uppercase text-xs text-gray-700
                                    transition-all ease-in-out duration-150
                                    border border-primary-100
                                    outline-none focus:ring-2 focus:ring-offset-2
                                    disabled:cursor-not-allowed disabled:bg-slate-200 disabled:opacity-50 disabled:border-slate-200
                                "
                                :class="{
                                    'text-white bg-primary-500 font-semibold focus:ring-primary-600':  year.isSelected,
                                    'hover:bg-primary-100 hover:text-primary-900 hover:font-medium': !year.isSelected,
                                    'bg-primary-50 shadow-sm font-medium text-slate-600': !year.isSelected,
                                    'focus:ring-primary-200 focus:bg-primary-100': !year.isSelected,
                                }"
                                :disabled="year.isDisabled"
                                x-on:click="selectYear(year.number)"
                                x-text="year.number"
                            ></button>
                        </template>
                    </div>
                </template>

                <div x-show="tab === 'calendar'">
                    <div class="grid grid-cols-7 gap-1">
                        <template x-for="day in weekDays" :key="`week-day.${day}`">
                            <span
                                class="text-center uppercase pointer-events-none text-secondary-400 text-3xs"
                                x-text="day"
                            ></span>
                        </template>

                        <template
                            x-for="day in calendar.dates"
                            :key="day.date"
                        >
                            <button
                                @class([
                                    'relative text-sm h-8 w-full rounded disabled:cursor-not-allowed',
                                    'flex items-center justify-center',
                                    'focus:outline-none',
                                    'disabled:opacity-50',
                                ])
                                :class="{
                                    'text-white bg-primary-500 font-semibold': day.isSelected,
                                    'disabled:bg-primary-400': day.isSelected,
                                    'hover:bg-primary-400': day.isSelected,
                                    'focus:bg-primary-400': day.isSelected,
                                    'focus:ring-2 focus:ring-primary-600 focus:ring-inset': day.isSelected && !day.isDisabled,

                                    'text-secondary-400': !day.isSelectedMonth,

                                    'text-primary-600 font-medium': day.isToday,

                                    'focus:ring-[1.5px] focus:ring-primary-500 focus:ring-inset': !day.isSelected && !day.isDisabled,
                                    'hover:bg-primary-100 hover:text-primary-600': !day.isSelected && !day.isDisabled,
                                    'focus:bg-primary-100 focus:text-primary-600': !day.isSelected && !day.isDisabled,

                                    'bg-slate-200': day.isDisabled && !day.isSelected,
                                }"
                                :disabled="day.isDisabled"
                                x-on:click="selectDay(day)"
                                type="button"
                            >
                                <span x-text="day.number"></span>

                                <div
                                    x-show="day.isToday"
                                    class="absolute rounded-full size-1 bottom-1"
                                    :class="{
                                        'bg-primary-600': !day.isSelected,
                                        'bg-white': day.isSelected,
                                    }"
                                ></div>
                            </button>
                        </template>
                    </div>
                </div>

                <template x-if="tab === 'time-picker'">
                    <x-dynamic-component
                        :component="WireUi::component('time-selector')"
                        class="!mt-0"
                        x-model="time"
                        :military-time="false"
                        :without-seconds="$withoutTimeSeconds"
                        borderless
                        shadowless
                    />
                </template>
            </div>

            @if (isset($footer))
                <footer {{ $footer->attributes }}>
                    {{ $footer }}
                </footer>
            @else
                <footer
                    class="flex items-center justify-end w-full gap-2 p-2 rounded-b-xl bg-slate-100"
                    x-show="shouldShowFooter"
                >
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        x-on:click="cancel"
                        flat gray sm
                    >
                        <span class="text-gray-400 group-hover:text-gray-600 group-focus:text-gray-600">
                            {{ trans('wireui::messages.date_picker.cancel') }}
                        </span>
                    </x-dynamic-component>

                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        :label="trans('wireui::messages.date_picker.apply')"
                        x-on:click="positionable.close()"
                        primary sm
                    />
                </footer>
            @endif
        </x-dynamic-component>
    </x-slot:after>
</x-dynamic-component>
