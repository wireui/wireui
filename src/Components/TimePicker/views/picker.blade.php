<x-text-field
    :x-data="WireUi::alpine('wireui_time_picker')"
    :x-props="WireUi::toJs([
        'militaryTime'   => $militaryTime,
        'withoutSeconds' => $withoutSeconds,
        'disabled'       => $disabled,
        'readonly'       => $readonly,
        'wireModel'      => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
        'alpineModel'    => WireUi::alpineModel($attributes),
    ])"
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class'])"
    x-ref="container"
>
    @include('wireui-wrapper::components.slots')

    <x-wireui-wrapper::element
        x-model.fill="input"
        x-ref="input"
        x-on:blur="onBlur"
        :attributes="$attrs->except(['wire:key', 'x-data', 'class'])"
        x-on:keydown.arrow-up.prevent="positionable.close()"
        x-on:keydown.arrow-down.prevent="positionable.open()"
    />

    <x-slot:append class="flex items-center">
        <x-dynamic-component
            :component="WireUi::component('icon')"
            @class([
                'w-4 h-4 mr-2 transition-colors duration-150 ease-in-out cursor-pointer hover:text-negative-500',
                'text-gray-400 dark:text-gray-600',
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
            :rounded="Arr::get($roundedClasses, 'append', '')"
            use-validation-colors
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
        <x-popover2 :margin="(bool) $label">
            <x-time-selector
                :name="$name . ':raw'"
                x-modelable="value"
                :military-time="$militaryTime"
                :without-seconds="$withoutSeconds"
                :disabled="$disabled"
                :readonly="$readonly"
                borderless
                shadowless
            />
        </x-popover2>
    </x-slot:after>
</x-text-field>
