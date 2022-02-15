<div x-data="wireui_datetime_picker({
        model: @entangle($attributes->wire('model')),
        config: {
            interval: {{ $interval }},
            is12H:    @boolean($timeFormat == '12'),
            readonly: @boolean($readonly),
            disabled: @boolean($disabled),
            min: @js($min ? $min->format('Y-m-d\TH:i') : null),
            max: @js($max ? $max->format('Y-m-d\TH:i') : null),
        },
        withoutTimezone: @boolean($withoutTimezone),
        timezone:      '{{ $timezone }}',
        userTimezone:  '{{ $userTimezone }}',
        parseFormat:   '{{ $parseFormat }}',
        displayFormat: '{{ $displayFormat }}',
        weekDays:   @lang('wireui::messages.datePicker.days'),
        monthNames: @lang('wireui::messages.datePicker.months'),
        withoutTime: @boolean($withoutTime),
    })"
    class="relative"
    {{ $attributes->only('wire:key') }}>
    <x-dynamic-component
        :component="WireUiComponent::resolve('input')"
        {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model', 'wire:key']) }}
        :borderless="$borderless"
        :shadowless="$shadowless"
        :label="$label"
        :hint="$hint"
        :corner-hint="$cornerHint"
        :icon="$icon"
        :prefix="$prefix"
        :prepend="$prepend"
        readonly
        x-on:click="togglePicker"
        x-bind:value="model ? getDisplayValue(): null">
        @if (!$readonly && !$disabled)
            <x-slot name="append">
                <div class="absolute inset-y-0 right-3 z-5 flex items-center justify-center">
                    <div class="flex items-center gap-x-2 my-auto
                        {{ $errors->has($name) ? 'text-negative-400 dark:text-negative-600' : 'text-secondary-400' }}">

                        @if ($clearable)
                            <x-dynamic-component
                                :component="WireUiComponent::resolve('icon')"
                                class="cursor-pointer w-4 h-4 hover:text-negative-500 transition-colors ease-in-out duration-150"
                                x-cloak
                                name="x"
                                x-show="model"
                                x-on:click="clearDate()"
                            />
                        @endif

                        <x-dynamic-component
                            :component="WireUiComponent::resolve('icon')"
                            class="cursor-pointer w-5 h-5"
                            :name="$rightIcon"
                            x-on:click="togglePicker"
                        />
                    </div>
                </div>
            </x-slot>
        @endif
    </x-dynamic-component>

    <div class="fixed inset-0 z-20 overflow-y-auto sm:absolute sm:inset-auto sm:top-10 sm:mt-1 sm:right-0"
         x-cloak
         style="display: none;"
         x-show="popover"
         x-on:click.outside="closePicker"
         x-on:keydown.escape.window="handleEscape">
        <div class="flex items-end justify-center min-h-screen sm:h-96 sm:items-start"
             style="min-height: -webkit-fill-available; min-height: fill-available;">
            <div class="fixed inset-0 bg-secondary-400 bg-opacity-60 transition-opacity sm:hidden
                        dark:bg-secondary-700 dark:bg-opacity-60"
                 x-show="popover"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 x-on:click="closePicker"
                 aria-hidden="true">
            </div>

            <div class="w-full rounded-t-md border border-secondary-200 bg-white shadow-lg
                        dark:bg-secondary-800 dark:border-secondary-600 transition-all relative
                        max-h-96 overflow-y-auto p-3 sm:w-72 sm:rounded-xl"
                 x-show="popover"
                 tabindex="-1"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <div x-show="tab === 'date'" class="space-y-5">
                    @unless ($withoutTips)
                        <div class="grid grid-cols-3 gap-x-2 text-center text-secondary-600">
                            <x-dynamic-component
                                :component="WireUiComponent::resolve('button')"
                                class="bg-secondary-100 border-none dark:bg-secondary-800"
                                x-on:click="selectYesterday"
                                label="{{ __('wireui::messages.datePicker.yesterday') }}"
                            />

                            <x-dynamic-component
                                :component="WireUiComponent::resolve('button')"
                                class="bg-secondary-100 border-none dark:bg-secondary-800"
                                x-on:click="selectToday"
                                label="{{ __('wireui::messages.datePicker.today') }}"
                            />

                            <x-dynamic-component
                                :component="WireUiComponent::resolve('button')"
                                class="bg-secondary-100 border-none dark:bg-secondary-800"
                                x-on:click="selectTomorrow"
                                label="{{ __('wireui::messages.datePicker.tomorrow') }}"
                            />
                        </div>
                    @endunless

                    <div class="flex items-center justify-between">
                        <x-dynamic-component
                            :component="WireUiComponent::resolve('button')"
                            class="rounded-lg shrink-0"
                            x-show="!monthsPicker"
                            x-on:click="previousMonth"
                            icon="chevron-left"
                            flat
                        />

                        <div class="w-full flex items-center justify-center gap-x-2 text-secondary-600 dark:text-secondary-500">
                            <button class="focus:outline-none focus:underline"
                                    x-text="monthNames[month]"
                                    x-on:click="monthsPicker = !monthsPicker"
                                    type="button">
                            </button>
                            <input class="w-10 sm:w-14 appearance-none p-0 ring-0 border-none focus:ring-0 focus:outline-none dark:bg-secondary-800"
                                   x-model="year"
                                   x-on:input.debounce.500ms="fillPickerDates"
                                   type="number"
                            />
                        </div>


                        <x-dynamic-component
                            :component="WireUiComponent::resolve('button')"
                            class="rounded-lg shrink-0"
                            x-show="!monthsPicker"
                            x-on:click="nextMonth"
                            icon="chevron-right"
                            flat
                        />
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 bg-white dark:bg-secondary-800 grid grid-cols-3 gap-3"
                             x-show="monthsPicker"
                             x-transition>
                            <template x-for="(monthName, index) in monthNames" :key="`month.${monthName}`">
                                <x-dynamic-component
                                    :component="WireUiComponent::resolve('button')"
                                    class="text-secondary-400 dark:border-0 dark:hover:bg-secondary-700 uppercase"
                                    x-on:click="selectMonth(index)"
                                    xs
                                    x-text="monthName"
                                />
                            </template>
                        </div>

                        <div class="grid grid-cols-7 gap-2">
                            <template x-for="day in weekDays" :key="`week-day.${day}`">
                                <span class="text-secondary-400 text-3xs text-center uppercase pointer-events-none"
                                    x-text="day">
                                </span>
                            </template>

                            <template
                                x-for="date in dates"
                                :key="`week-date.${date.day}.${date.month}`">
                                <div class="flex justify-center picker-days">
                                    <button class="text-sm w-7 h-6 focus:outline-none rounded-md focus:ring-2 focus:ring-ofsset-2 focus:ring-primary-600
                                                 hover:bg-primary-100 dark:hover:bg-secondary-700 dark:focus:ring-secondary-400
                                                  disabled:cursor-not-allowed"
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
                                        type="button">
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div x-show="tab === 'time'" x-transition>
                    <x-dynamic-component
                        :component="WireUiComponent::resolve('input')"
                        id="search.{{ $attributes->wire('model')->value() }}"
                        label="Select time"
                        x-model="searchTime"
                        x-bind:placeholder="modelTime ? modelTime : '12:00'"
                        x-ref="searchTime"
                        x-on:input.debounce.150ms="onSearchTime($event.target.value)"
                    />

                    <div x-ref="timesContainer"
                         class="mt-1 w-full max-h-52 pb-1 pt-2 overflow-y-auto flex flex-col picker-times">
                        <template x-for="time in filteredTimes">
                            <button class="group rounded-md focus:outline-none focus:bg-primary-100 dark:focus:bg-secondary-700
                                           relative py-2 pl-2 pr-9 text-left transition-colors ease-in-out duration-100 cursor-pointer select-none
                                           hover:text-white hover:bg-primary-600 dark:hover:bg-secondary-700 dark:text-secondary-400"
                                    :class="{
                                    'text-primary-600': modelTime === time.value,
                                    'text-secondary-700': modelTime !== time.value,
                                }"
                                :name="`times.${time.value}`"
                                type="button"
                                x-on:click="selectTime(time)">
                                <span x-text="time.label"></span>
                                <span class="text-primary-600 dark:text-secondary-400 group-hover:text-white
                                             absolute inset-y-0 right-0 flex items-center pr-4"
                                      x-show="modelTime === time.value">
                                    <x-dynamic-component
                                        :component="WireUiComponent::resolve('icon')"
                                        name="check"
                                        class="h-5 w-5"
                                    />
                                </span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
