<x-dynamic-component
    :component="WireUi::component('text-field')"
    x-ref="container"
    :config="$config"
    :attributes="$wrapper"
    :x-data="WireUi::alpine('wireui_time_picker')"
    :x-props="WireUi::toJs([
        'militaryTime'   => $militaryTime,
        'withoutSeconds' => $withoutSeconds,
        'disabled'       => $disabled,
        'readonly'       => $readonly,
        'wireModel'      => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
        'alpineModel'    => WireUi::alpineModel($attributes),
    ])"
>
    @include('wireui-wrapper::components.slots')

    <div class="hidden" hidden>
        <x-wireui-wrapper::hidden
            :name="$name"
            :value="$value"
            x-ref="rawInput"
            x-bind:value="value"
        />
    </div>

    <x-wireui-wrapper::element
        x-ref="input"
        x-model="input"
        x-on:blur="onBlur"
        :attributes="$input"
        x-on:keydown.arrow-up.prevent="positionable.close()"
        x-on:keydown.arrow-down.prevent="positionable.open()"
    />

    <x-slot:append class="flex items-center">
        <x-dynamic-component
            :component="WireUi::component('icon')"
            @class([
                'w-4 h-4 mr-2 transition-colors duration-150 ease-in-out cursor-pointer hover:text-negative-500',
                'text-gray-400 dark:text-gray-600',
                'invalidated:text-negative-500',
            ])
            x-cloak
            name="x-mark"
            x-show="input"
            x-on:click="clear"
        />

        <x-dynamic-component
            :component="WireUi::component('button')"
            class="h-full"
            :color="$color ?? 'primary'"
            :rounded="data_get($roundedClasses, 'append', '')"
            use-validation-colors
            flat
            x-on:click="positionable.toggle()"
            :disabled="$disabled"
            x-on:keydown.arrow-up.prevent="positionable.close()"
            x-on:keydown.arrow-down.prevent="
                positionable.open();
                $nextTick(() => focusable.next()?.focus())
            "
        >
            <x-dynamic-component
                :component="WireUi::component('icon')"
                :name="$rightIcon"
                @class([
                    'w-4 h-4 group-focus:text-primary-700 text-gray-400 dark:text-gray-600',
                    'dark:group-hover:text-gray-500 dark:group-focus:text-primary-500',
                    'invalidated:text-negative-500 invalidated:group-focus:text-negative-600',
                ])
            />
        </x-dynamic-component>
    </x-slot:append>

    <x-slot:after>
        <x-dynamic-component
            :component="WireUi::component('popover')"
            :margin="(bool) $label"
        >
            <x-dynamic-component
                :component="WireUi::component('time-selector')"
                :name="$name . ':raw'"
                x-model="value"
                :military-time="$militaryTime"
                :without-seconds="$withoutSeconds"
                :disabled="$disabled"
                :readonly="$readonly"
                borderless
                shadowless
            />
        </x-dynamic-component>
    </x-slot:after>
</x-dynamic-component>
