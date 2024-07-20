<x-dynamic-component
    :component="WireUi::component('text-field')"
    :config="$config"
    :attributes="$wrapper"
    x-data="wireui_inputs_number"
    :x-props="WireUi::toJs([
        'disabled' => $disabled,
        'readonly' => $readonly,
    ])"
>
    @include('wireui-wrapper::components.slots', [
        'except' => ['prepend', 'append'],
    ])

    <x-slot:prepend>
        <x-dynamic-component
            :component="WireUi::component('button')"
            :color="$color ?? 'primary'"
            :rounded="data_get($roundedClasses, 'prepend', '')"
            x-hold.click.delay.repeat.100ms="minus"
            x-bind:disabled="disableMinus"
            x-on:keydown.enter="minus"
            use-validation-colors
            :icon="$icon"
            flat
        />
    </x-slot:prepend>

    <x-wireui-wrapper::element
        type="number"
        x-ref="input"
        inputmode="numeric"
        x-on:keydown.up.stop.prevent="plus"
        x-on:keydown.down.stop.prevent="minus"
        :attributes="$input->class('text-center appearance-number-none')"
    />

    <x-slot:append>
        <x-dynamic-component
            :component="WireUi::component('button')"
            x-hold.click.delay.repeat.100ms="plus"
            :color="$color ?? 'primary'"
            :rounded="data_get($roundedClasses, 'append', '')"
            x-bind:disabled="disablePlus"
            x-on:keydown.enter="plus"
            use-validation-colors
            :icon="$rightIcon"
            flat
        />
    </x-slot:append>
</x-dynamic-component>
