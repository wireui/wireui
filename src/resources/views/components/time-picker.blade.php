<x-inputs.wrapper
    x-data="wireui_timepicker"
    :x-props="WireUi::phpToJs([
        'isBlur'    => $attrs->wire('model')->hasModifier('blur'),
        'interval'  => $interval,
        'format'    => $format,
        'is12H'     => $format == '12',
        'readonly'  => $readonly,
        'disabled'  => $disabled,
        'wireModel' => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
    ])"
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class'])"
>
    @include('wireui::form.wrapper.slots')

    <x-wireui::inputs.element
        x-model="input"
        x-on:blur="onBlur"
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
                class="cursor-pointer w-4 h-4 hover:text-negative-500 transition-colors ease-in-out duration-150"
                x-cloak
                name="x-mark"
                x-show="!config.readonly && !config.disabled && input"
                x-on:click="clearInput"
            />

            <x-dynamic-component
                :component="WireUi::component('icon')"
                class="cursor-pointer w-5 h-5 text-gray-400 dark:text-gray-600"
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
            :label="trans('wireui::messages.selectTime')"
            tabindex="0"
            x-model="search"
            x-bind:placeholder="input ? input : '12:00'"
            x-ref="search"
            x-on:input.debounce.150ms="onSearch($event.target.value)"
        />

        <ul class="mt-1 w-full h-64 sm:h-32 pb-1 pt-2 overflow-y-auto soft-scrollbar">
            <template x-for="time in filteredTimes">
                <li
                    class="
                        group rounded-md focus:outline-none focus:bg-primary-100 hover:text-white
                        hover:bg-primary-600 cursor-pointer select-none relative py-2 pl-2 pr-9
                        dark:hover:bg-secondary-700
                    "
                    :class="{
                        'text-primary-600 dark:text-secondary-400':   input === time.value,
                        'text-secondary-700 dark:text-secondary-400': input !== time.value,
                    }"
                    tabindex="0"
                    x-on:keydown.enter="selectTime(time)"
                    x-on:click="selectTime(time)"
                >
                    <span x-text="time.label" class="font-normal block truncate"></span>

                    <span
                        class="
                            absolute text-primary-600 group-hover:text-white inset-y-0
                            right-0 flex items-center pr-4 dark:text-secondary-400
                        "
                        x-show="input === time.value"
                    >
                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            name="check"
                            class="h-5 w-5"
                        />
                    </span>
                </li>
            </template>
        </ul>
    </x-wireui::parts.popover>
</x-inputs.wrapper>
