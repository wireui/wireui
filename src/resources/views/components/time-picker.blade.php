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
>
    @include('wireui::components.wrapper.slots')

    <x-wireui::wrapper.element
        x-model="input"
        x-on:input.debounce.150ms="onInput($event.target.value)"
        x-on:blur="emitInput"
        :attributes="$attrs->except(['wire:key', 'x-data', 'class'])"
    />

    <x-slot:append>
        <div @class([
            'flex items-center gap-x-2 my-auto',
            'text-negative-400 dark:text-negative-600' => $name && $errors->has($name),
            'text-secondary-400'                       => $name && $errors->has($name),
        ])>
            <x-dynamic-component
                :component="WireUi::component('icon')"
                class="w-4 h-4 transition-colors duration-150 ease-in-out cursor-pointer hover:text-negative-500"
                x-cloak
                name="x-mark"
                x-show="!config.readonly && !config.disabled && input"
                x-on:click="clearInput"
            />

            <x-dynamic-component
                :component="WireUi::component('icon')"
                class="w-5 h-5 text-gray-400 cursor-pointer dark:text-gray-600"
                name="clock"
                x-show="!config.readonly && !config.disabled"
                x-on:click="toggle"
            />
        </div>
    </x-slot:append>

    <x-wireui::parts.popover
        class="p-2.5"
        :margin="(bool) $label"
        x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
        x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
        x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
        x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
    >
        <x-dynamic-component
            :component="WireUi::component('input')"
            :label="trans('wireui::messages.select_time')"
            tabindex="0"
            x-model="search"
            x-bind:placeholder="input ? input : '12:00'"
            x-ref="search"
            x-on:input.debounce.150ms="onSearch($event.target.value)"
        />

        <ul class="w-full h-64 pt-2 pb-1 mt-1 overflow-y-auto sm:h-32 soft-scrollbar">
            <template x-for="time in filteredTimes">
                <li
                    class="relative py-2 pl-2 rounded-md cursor-pointer select-none group focus:outline-none focus:bg-primary-100 hover:text-white hover:bg-primary-600 pr-9 dark:hover:bg-secondary-700"
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
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-primary-600 group-hover:text-white dark:text-secondary-400"
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
    </x-wireui::parts.popover>
</x-wrapper>
