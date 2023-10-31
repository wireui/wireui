<x-wrapper
    :x-data="WireUi::alpine('wireui_datetime_picker', [
        'model' => null
    ])"
    :data="$wrapperData"
    :attributes="$attrs->only('wire:key')"
    :x-props="WireUi::toJs([
        'config' => [
            'interval' => $interval,
            'is12H'    => $timeFormat == '12',
            'readonly' => $readonly,
            'disabled' => $disabled,
            'min'      => $min?->format('Y-m-d\TH:i'),
            'max'      => $max?->format('Y-m-d\TH:i'),
            'minTime'  => $minTime,
            'maxTime'  => $maxTime,
        ],
        'withoutTimezone' => $withoutTimezone,
        'timezone'        => $timezone,
        'userTimezone'    => $userTimezone ?? '',
        'parseFormat'     => $parseFormat ?? '',
        'displayFormat'   => $displayFormat ?? '',
        'weekDays'        => trans('wireui::messages.date_picker.days'),
        'monthNames'      => trans('wireui::messages.date_picker.months'),
        'withoutTime'     => $withoutTime,
    ])"
    x-ref="container"
>
    @include('wireui::components.wrapper.slots')

    @if (!$readonly && !$disabled)
        <x-slot:append class="flex items-center">
            @if ($clearable)
                <x-dynamic-component
                    :component="WireUi::component('icon')"
                    class="w-4 h-4 mr-2 transition-colors duration-150 ease-in-out cursor-pointer text-gray-400 hover:text-negative-500"
                    x-cloak
                    name="x-mark"
                    x-show="model"
                    x-on:click="clearDate()"
                />
            @endif

            <x-dynamic-component
                :component="WireUi::component('button')"
                class="h-full"
                :color="$color ?? 'primary'"
                :rounded="Arr::get($roundedClasses, 'append', '')"
                flat
                x-on:click="toggle"
                :disabled="$disabled"
                x-on:keydown.arrow-down.prevent="focusable.walk.to('down')"
            >
                <x-dynamic-component
                    :component="WireUi::component('icon')"
                    :name="$rightIcon"
                    @class([
                        'w-4 h-4 group-focus:text-primary-700 text-gray-400 dark:text-gray-600',
                        'dark:group-hover:text-gray-500 dark:group-focus:text-primary-500',
                    ])
                />
            </x-dynamic-component>
        </x-slot:append>
    @endif

    <x-wireui::wrapper.element
        readonly
        x-on:click="toggle"
        x-bind:value="model ? getDisplayValue() : null"
        :attributes="$attrs
            ->whereDoesntStartWith(['wire:model', 'x-model', 'wire:key', 'readonly'])
            ->except(['wire:key', 'x-data'])
        "
    />

    <x-slot:after>
        <x-wireui::parts.popover2
            :margin="(bool) $label"
            class="overflow-hidden max-h-96 sm:w-72"
            x-bind:class="{ 'p-2.5': tab === 'date' }"
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
            <div x-show="tab === 'date'" class="space-y-5">
                @unless ($withoutTips)
                    <div class="grid grid-cols-3 text-center gap-x-2 text-secondary-600">
                        <x-dynamic-component
                            :component="WireUi::component('button')"
                            x-on:click="selectYesterday"
                            :label="trans('wireui::messages.date_picker.yesterday')"
                            light
                            base
                        />

                        <x-dynamic-component
                            :component="WireUi::component('button')"
                            x-on:click="selectToday"
                            :label="trans('wireui::messages.date_picker.today')"
                            light
                            base
                        />

                        <x-dynamic-component
                            :component="WireUi::component('button')"
                            x-on:click="selectTomorrow"
                            :label="trans('wireui::messages.date_picker.tomorrow')"
                            light
                            base
                        />
                    </div>
                @endunless

                <div class="flex items-center justify-between">
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="rounded-lg shrink-0"
                        x-show="!monthsPicker"
                        x-on:click="previousMonth"
                        icon="chevron-left"
                        flat
                    />

                    <div class="flex items-center justify-center w-full gap-x-2 text-secondary-600 dark:text-secondary-500">
                        <button
                            class="focus:outline-none focus:underline"
                            x-text="monthNames[month]"
                            x-on:click="monthsPicker = !monthsPicker"
                            type="button"
                        ></button>

                        <input
                            class="p-0 border-none appearance-none w-14 ring-0 focus:ring-0 focus:outline-none dark:bg-secondary-800"
                            x-model="year"
                            x-on:input.debounce.500ms="fillPickerDates"
                            type="number"
                        />
                    </div>

                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="rounded-lg shrink-0"
                        x-show="!monthsPicker"
                        x-on:click="nextMonth"
                        icon="chevron-right"
                        flat
                    />
                </div>

                <div class="relative">
                    <div
                        class="grid grid-cols-3 gap-5"
                        x-show="monthsPicker"
                        x-transition:enter
                    >
                        <template x-for="(monthName, index) in monthNames" :key="`month.${monthName}`">
                            <x-dynamic-component
                                :component="WireUi::component('button')"
                                class="uppercase text-secondary-400 dark:border-0 dark:hover:bg-secondary-700"
                                x-on:click="selectMonth(index)"
                                x-text="monthName"
                                xs base flat
                            />
                        </template>
                    </div>

                    <div
                        class="grid grid-cols-7 gap-2"
                        x-show="!monthsPicker"
                        x-transition:enter
                    >
                        <template x-for="day in weekDays" :key="`week-day.${day}`">
                            <span
                                class="text-center uppercase pointer-events-none text-secondary-400 text-3xs"
                                x-text="day"
                            ></span>
                        </template>

                        <template
                            x-for="date in dates"
                            :key="`date.${date.day}.${date.month}`"
                        >
                            <button
                                @class([
                                    'text-sm w-7 h-6 focus:outline-none rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-primary-600',
                                    'hover:bg-primary-100 dark:hover:bg-secondary-700 dark:focus:ring-secondary-400',
                                    'disabled:cursor-not-allowed focus:border-none',
                                ])
                                :class="{
                                    'text-secondary-600 dark:text-secondary-400': !date.isDisabled && !date.isSelected && date.month === month,
                                    'text-secondary-400 dark:text-secondary-600': date.isDisabled || date.month !== month,
                                    'text-primary-600 border border-primary-600 dark:border-gray-400': date.isToday && !date.isSelected,
                                    'disabled:text-primary-400 disabled:border-primary-400': date.isToday && !date.isSelected,
                                    '!text-white bg-primary-600 font-semibold border border-primary-600': date.isSelected,
                                    'disabled:bg-primary-400 disabled:border-primary-400': date.isSelected,
                                    'hover:bg-primary-600 dark:bg-secondary-700 dark:border-secondary-400': date.isSelected,
                                }"
                                :disabled="date.isDisabled"
                                x-on:click="selectDate(date)"
                                x-text="date.day"
                                type="button"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>

            <div x-show="tab === 'time'" x-transition:enter>
                <div class="p-2.5">
                    <x-dynamic-component
                        :component="WireUi::component('input')"
                        id="search.{{ $attrs->wire('model')->value() }}"
                        :label="trans('wireui::messages.search_here')"
                        x-model="searchTime"
                        x-bind:placeholder="getSearchPlaceholder"
                        x-ref="searchTime"
                        x-on:input.debounce.150ms="onSearchTime($event.target.value)"
                    />
                </div>

                <div
                    @class([
                       'max-h-52 overflow-y-auto overscroll-contain soft-scrollbar p-2.5',
                       'flex flex-col gap-1 sm:gap-0.5',
                       'snap-proximity snap-y'
                    ])
                    x-ref="timesContainer"
                >
                    <template x-for="time in filteredTimes">
                        <button
                            @class([
                                'group rounded-md focus:outline-none focus:bg-primary-100 hover:text-white',
                                'hover:bg-primary-600 cursor-pointer select-none relative py-2 pl-2 pr-9',
                                'dark:hover:bg-secondary-700',
                                'snap-start',
                            ])
                            :class="{
                                'text-primary-600 dark:text-secondary-400':   modelTime === time.value,
                                'text-secondary-700 dark:text-secondary-400': modelTime !== time.value,
                            }"
                            tabindex="0"
                            x-on:keydown.enter="selectTime(time)"
                            x-on:click="selectTime(time)"
                        >
                            <span x-text="time.label" class="text-left block font-normal truncate"></span>

                            <span
                                @class([
                                    'absolute text-primary-600 group-hover:text-white inset-y-0',
                                    'right-0 flex items-center pr-4 dark:text-secondary-400',
                                ])
                                x-show="modelTime === time.value"
                            >
                                <x-dynamic-component
                                    :component="WireUi::component('icon')"
                                    name="check"
                                    class="w-5 h-5"
                                />
                            </span>
                        </button>
                    </template>
                </div>
            </div>
        </x-wireui::parts.popover2>
    </x-slot:after>
</x-wrapper>
