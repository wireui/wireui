<x-inputs.wrapper
    x-data="wireui_datetime_picker"
    :x-props="WireUi::phpToJs([
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
         'monthNames'     => __('wireui::messages.date_picker.months'),
        'withoutTime'     => $withoutTime,
        'wireModel'       => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
    ])"
    :data="$wrapperData"
    :attributes="$attrs->only('wire:key')"
>
    @include('wireui::form.wrapper.slots')

    @if (!$readonly && !$disabled)
        <x-slot:append>
            <div @class([
                'flex items-center gap-x-2 my-auto pr-2',
                'text-negative-400 dark:text-negative-600' => $invalidated,
                'text-secondary-400'                       => !$invalidated,
            ])>
                @if ($clearable)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        class="cursor-pointer w-4 h-4 hover:text-negative-500 transition-colors ease-in-out duration-150"
                        x-cloak
                        name="x-mark"
                        x-show="entangleable.get()"
                        x-on:click.prevent="clearDate()"
                    />
                @endif

                <x-dynamic-component
                    :component="WireUi::component('icon')"
                    class="cursor-pointer w-5 h-5"
                    :name="$rightIcon"
                />
            </div>
        </x-slot:append>
    @endif

    <x-wireui::inputs.element
        readonly
        x-on:click="toggle"
        x-bind:value="entangleable.get() ? getDisplayValue() : null"
        :attributes="$attrs
            ->class('cursor-pointer')
            ->whereDoesntStartWith(['wire:model', 'x-model', 'wire:key', 'readonly'])
            ->except('x-data')
        "
    />

    <x-wireui::parts.popover
        class="max-h-96 overflow-y-auto p-3 sm:w-72"
        root-class="sm:w-full sm:justify-end"
        :margin="(bool) $label"
    >
        <div x-show="tab === 'date'" class="space-y-5">
            @unless ($withoutTips)
                <div class="grid grid-cols-3 gap-x-2 text-center text-secondary-600">
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="bg-secondary-100 border-none dark:bg-secondary-800"
                        x-on:click="selectYesterday"
                        :label="__('wireui::messages.date_picker.yesterday')"
                    />

                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="bg-secondary-100 border-none dark:bg-secondary-800"
                        x-on:click="selectToday"
                        :label="__('wireui::messages.date_picker.today')"
                    />

                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="bg-secondary-100 border-none dark:bg-secondary-800"
                        x-on:click="selectTomorrow"
                        :label="__('wireui::messages.date_picker.tomorrow')"
                    />
                </div>
            @endunless

            <div class="flex items-center justify-between">
                <x-dynamic-component
                    :component="WireUi::component('button')"
                    class="rounded-lg shrink-0"
                    x-show="!$props.monthsPicker"
                    x-on:click="previousMonth"
                    icon="chevron-left"
                    flat
                />

                <div class="w-full flex items-center justify-center gap-x-2 text-secondary-600 dark:text-secondary-500">
                    <button
                        class="focus:outline-none focus:underline"
                        x-text="$props.monthNames[month]"
                        x-on:click="$props.monthsPicker = !$props.monthsPicker"
                        type="button"
                    ></button>

                    <input
                        class="w-14 appearance-none p-0 ring-0 border-none focus:ring-0 focus:outline-none dark:bg-secondary-800"
                        x-model="year"
                        x-on:input.debounce.500ms="fillPickerDates"
                        type="number"
                    />
                </div>

                <x-dynamic-component
                    :component="WireUi::component('button')"
                    class="rounded-lg shrink-0"
                    x-show="!$props.monthsPicker"
                    x-on:click="nextMonth"
                    icon="chevron-right"
                    flat
                />
            </div>

            <div class="relative">
                <div
                    class="absolute inset-0 bg-white dark:bg-secondary-800 grid grid-cols-3 gap-3"
                    x-show="$props.monthsPicker"
                    x-transition
                >
                    @foreach(__('wireui::messages.date_picker.months') as $month)
                        <x-dynamic-component
                            :component="WireUi::component('button')"
                            class="text-secondary-400 dark:border-0 dark:hover:bg-secondary-700 uppercase"
                            x-on:click="selectMonth({{ $loop->index }})"
                            :label="$month"
                            xs
                        />
                    @endforeach
                </div>

                <div class="grid grid-cols-7 gap-2">
                    @foreach(__('wireui::messages.date_picker.days') as $day)
                        <span class="text-secondary-400 text-3xs text-center uppercase pointer-events-none">
                            {{ $day }}
                        </span>
                    @endforeach

                    <template
                        x-for="date in dates"
                        :key="`date.${date.year}.${date.month}.${date.day}`"
                    >
                        <div class="flex justify-center picker-days">
                            <button
                                class="
                                    text-sm w-7 h-6 focus:outline-none rounded-md focus:ring-2 focus:ring-offset-2 focus:ring-primary-600
                                    hover:bg-primary-100 dark:hover:bg-secondary-700 dark:focus:ring-secondary-400
                                    disabled:cursor-not-allowed
                                "
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
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div x-show="tab === 'time'" x-transition>
            <x-dynamic-component
                :component="WireUi::component('input')"
                id="search.{{ $attrs->wire('model')->value() }}"
                :label="__('wireui::messages.selectTime')"
                x-model="searchTime"
                x-bind:placeholder="getSearchPlaceholder"
                x-ref="searchTime"
                x-on:input.debounce.150ms="onSearchTime($event.target.value)"
            />

            <div
                class="mt-1 w-full max-h-52 pb-1 pt-2 overflow-y-auto soft-scrollbar flex flex-col picker-times"
                x-ref="timesContainer"
            >
                <template x-for="time in filteredTimes" :key="time.value">
                    <button
                        class="
                            group rounded-md focus:outline-none focus:bg-primary-100 dark:focus:bg-secondary-700
                            relative py-2 pl-2 pr-9 text-left transition-colors ease-in-out duration-100 cursor-pointer select-none
                            hover:text-white hover:bg-primary-600 dark:hover:bg-secondary-700 dark:text-secondary-400
                        "
                        :class="{
                            'text-primary-600': modelTime === time.value,
                            'text-secondary-700': modelTime !== time.value,
                        }"
                        :name="`times.${time.value}`"
                        type="button"
                        x-on:click="selectTime(time)"
                    >
                        <span x-text="time.label"></span>

                        <span
                            class="
                                text-primary-600 dark:text-secondary-400 group-hover:text-white
                                absolute inset-y-0 right-0 flex items-center pr-4
                            "
                            x-show="modelTime === time.value"
                        >
                            <x-dynamic-component
                                :component="WireUi::component('icon')"
                                name="check"
                                class="h-5 w-5"
                            />
                        </span>
                    </button>
                </template>
            </div>
        </div>
    </x-wireui::parts.popover>
</x-inputs.wrapper>
