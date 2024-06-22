<x-dynamic-component
    :component="WireUi::component('text-field')"
    :data="$wrapperData"
    :right-icon="$rightIcon"
    :attributes="$attrs->only(['wire:key', 'class'])"
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
            :rounded="Arr::get($roundedClasses, 'prepend', '')"
            x-hold.click.delay.repeat.100ms="minus"
            x-bind:disabled="disableMinus"
            x-on:keydown.enter="minus"
            use-validation-colors
            :icon="$icon"
            flat
        />
    </x-slot:prepend>

    <x-wireui-wrapper::element
        :attributes="$attrs
            ->except(['class', 'wire:key', 'x-data'])
            ->class('text-center appearance-number-none')
        "
        x-on:keydown.down.stop.prevent="minus"
        x-on:keydown.up.stop.prevent="plus"
        inputmode="numeric"
        type="number"
        x-ref="input"
    />

    <x-slot:append>
        <x-dynamic-component
            :component="WireUi::component('button')"
            x-hold.click.delay.repeat.100ms="plus"
            :color="$color ?? 'primary'"
            :rounded="Arr::get($roundedClasses, 'append', '')"
            x-bind:disabled="disablePlus"
            x-on:keydown.enter="plus"
            use-validation-colors
            :icon="$rightIcon"
            flat
        />
    </x-slot:append>
</x-dynamic-component>
