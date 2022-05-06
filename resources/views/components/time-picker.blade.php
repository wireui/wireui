<div x-data="wireui_timepicker({
        model: @entangle($attributes->wire('model')),
        config: {
            isLazy: @boolean($attributes->wire('model')->hasModifier('lazy')),
            interval: {{ $interval }},
            format:  '{{ $format }}',
            is12H:    @boolean($format == '12'),
            readonly: @boolean($readonly),
            disabled: @boolean($disabled),
        },
    })"
    x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
    x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
    x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
    class="w-full relative"
    {{ $attributes->only('wire:key') }}>
    <div class="relative">
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
            x-model="input"
            x-on:input.debounce.150ms="onInput($event.target.value)"
            x-on:blur="emitInput">
            <x-slot name="append">
                <div class="absolute inset-y-0 right-3 z-5 flex items-center justify-center">
                    <div class="flex items-center gap-x-2 my-auto
                        {{ ($errors->has($name) ?? false)
                            ? 'text-negative-400 dark:text-negative-600'
                            :'text-secondary-400'
                        }}">
                        <x-dynamic-component
                            :component="WireUiComponent::resolve('icon')"
                            class="cursor-pointer w-4 h-4 hover:text-negative-500 transition-colors ease-in-out duration-150"
                            x-cloak
                            name="x"
                            x-show="!config.readonly && !config.disabled && input"
                            x-on:click="clearInput()"
                        />

                        <x-dynamic-component
                            :component="WireUiComponent::resolve('icon')"
                            class="cursor-pointer w-5 h-5"
                            name="clock"
                            x-show="!config.readonly && !config.disabled"
                            x-on:click="openPicker"
                        />
                    </div>
                </div>
            </x-slot>
        </x-dynamic-component>
    </div>

    <div class="fixed inset-0 z-10 sm:absolute sm:inset-auto sm:top-0 sm:right-0 sm:mt-6"
        x-cloak
        x-show="showPicker"
        x-on:click.outside="closePicker"
        x-on:keydown.escape.window="closePicker"
        wire:ignore>
        <div class="flex items-end justify-center h-screen sm:h-48"
            style="min-height: -webkit-fill-available; min-height: fill-available;">
            <div class="fixed inset-0 bg-secondary-500 bg-opacity-75 transition-opacity sm:hidden
                      dark:bg-secondary-700 dark:bg-opacity-60"
                x-show="showPicker"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-on:click="closePicker"
                aria-hidden="true">
            </div>

            <div class="w-full rounded-t-md p-2.5 border border-secondary-200 bg-white transition-all
                        relative sm:rounded-lg sm:shadow-md sm:w-48 dark:bg-secondary-800 dark:border-secondary-600"
                x-show="showPicker"
                tabindex="-1"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <button type="button" class="cursor-pointer hidden sm:flex absolute top-2 right-2 focus:outline-none" x-on:click="closePicker">
                    <x-dynamic-component
                        :component="WireUiComponent::resolve('icon')"
                        class="w-4 h-4 text-secondary-400 hover:text-negative-400 transition-all ease-out duration-150"
                        name="x"
                    />
                </button>

                <x-dynamic-component
                    :component="WireUiComponent::resolve('input')"
                    id="search.{{ $attributes->wire('model')->value() }}"
                    label="Select time"
                    :label="trans('wireui::messages.selectTime')"
                    x-model="search"
                    ::placeholder="input ? input : '12:00'"
                    tabindex="0"
                    x-ref="search"
                    x-on:input.debounce.150ms="onSearch($event.target.value)"
                />

                <ul class="mt-1 w-full h-64 sm:h-32 pb-1 pt-2 overflow-y-auto">
                    <template x-for="time in filteredTimes">
                        <li class="group rounded-md focus:outline-none focus:bg-primary-100 hover:text-white
                                 hover:bg-primary-600 cursor-pointer select-none relative py-2 pl-2 pr-9
                                 dark:hover:bg-secondary-700"
                            :class="{
                                'text-primary-600 dark:text-secondary-400': input === time,
                                'text-secondary-700 dark:text-secondary-400'  : input !== time,
                            }"
                            tabindex="0"
                            x-on:keydown.enter="selectTime(time)"
                            x-on:click="selectTime(time)">
                            <span x-text="time" class="font-normal block truncate"></span>
                            <span class="absolute text-primary-600 group-hover:text-white inset-y-0
                                         right-0 flex items-center pr-4 dark:text-secondary-400"
                                x-show="input === time">
                                <x-dynamic-component
                                    :component="WireUiComponent::resolve('icon')"
                                    name="check"
                                    class="h-5 w-5"
                                />
                            </span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</div>
