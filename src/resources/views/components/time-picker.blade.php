<x-wrapper
    :x-data="WireUi::alpine('wireui_timepicker', [
        'model'  => null,
        'config' => [
            'isBlur'   => $attrs->wire('model')->hasModifier('blur'),
            'interval' => $interval,
            'format'   => $format,
            'is12H'    => $format == '12',
            'readonly' => $readonly,
            'disabled' => $disabled,
        ]
    ])"
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class'])"
    x-ref="container"
>
    @include('wireui::components.wrapper.slots')

    <x-wireui::wrapper.element
        x-model="input"
        x-on:input.debounce.150ms="onInput($event.target.value)"
        x-on:blur="emitInput"
        :attributes="$attrs->except(['wire:key', 'x-data', 'class'])"
        x-on:keydown.arrow-up.prevent="focusable.previous()?.focus()"
        x-on:keydown.arrow-down.prevent="focusable.next()?.focus()"
    />

    <x-slot:append class="flex items-center">
        <x-dynamic-component
            :component="WireUi::component('icon')"
            @class([
                'w-4 h-4 transition-colors duration-150 ease-in-out cursor-pointer hover:text-negative-500',
                'text-gray-400 dark:text-gray-600',
            ])
            x-cloak
            name="x-mark"
            x-show="!config.readonly && !config.disabled && input"
            x-on:click="clearInput"
        />

        <x-dynamic-component
            :component="WireUi::component('button')"
            class="h-full"
            :color="$color ?? 'primary'"
            :rounded="Arr::get($roundedClasses, 'append', '')"
            flat
            x-on:click="positionable.toggle()"
            :disabled="$disabled"
            x-on:keydown.arrow-up.prevent="positionable.close()"
            x-on:keydown.arrow-down.prevent="
                positionable.open();
                focusable.next()?.focus();
            "
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

    <x-slot:after>
        <x-wireui::parts.popover2
            :margin="(bool) $label"
            root-class="justify-end sm:w-full"
            @class([
                'max-h-64 select-none soverflow-hidden',
                'sm:w-auto sm:max-w-xs',
            ])
            tabindex="-1"
            x-on:keydown.tab.prevent="$event.shiftKey || focusable.next()?.focus()"
            x-on:keydown.shift.tab.prevent="focusable.previous()?.focus()"
            x-on:keydown.arrow-up.prevent="focusable.previous()?.focus()"
            x-on:keydown.arrow-down.prevent="focusable.next()?.focus()"
        >
            <div class="p-2">
                <x-dynamic-component
                    :component="WireUi::component('input')"
                    :label="trans('wireui::messages.search_here')"
                    tabindex="0"
                    x-model="search"
                    x-bind:placeholder="input ? input : '12:00'"
                    x-ref="search"
                    x-on:input.debounce.150ms="onSearch($event.target.value)"
                />
            </div>

            <ul
                @class([
                   'max-h-44 overflow-y-auto overscroll-contain soft-scrollbar pb-2 px-2',
                   'flex flex-col gap-1 sm:gap-0.5',
                   'snap-proximity snap-y'
                ])
            >
                <template x-for="time in filteredTimes">
                    <li
                        @class([
                            'group rounded-md focus:outline-none focus:bg-primary-100 hover:text-white',
                            'hover:bg-primary-600 cursor-pointer select-none relative py-2 pl-2 pr-9',
                            'dark:hover:bg-secondary-700',
                            'snap-start',
                        ])
                        :class="{
                            'text-primary-600 dark:text-secondary-400':   input === time.value,
                            'text-secondary-700 dark:text-secondary-400': input !== time.value,
                        }"
                        tabindex="0"
                        x-on:keydown.enter="selectTime(time)"
                        x-on:click="selectTime(time)"
                    >
                        <span x-text="time.label" class="block font-normal truncate"></span>

                        <span
                            @class([
                                'absolute text-primary-600 group-hover:text-white inset-y-0',
                                'right-0 flex items-center pr-4 dark:text-secondary-400',
                            ])
                            x-show="input === time.value"
                        >
                            <x-dynamic-component
                                :component="WireUi::component('icon')"
                                name="check"
                                class="w-5 h-5"
                            />
                        </span>
                    </li>
                </template>
            </ul>
        </x-wireui::parts.popover2>
    </x-slot:after>
</x-wrapper>
