@php($attrs = $attributes)

<x-inputs.wrapper
    :data="$wrapperData"
    :right-icon="$rightIcon"
    :attributes="$attrs->only(['wire:key', 'class'])"
    x-data="wireui_inputs_number({
        disabled: {{ json_encode($disabled) }},
        readonly: {{ json_encode($readonly) }},
    })"
>
    @include('wireui::form.wrapper.slots', [
        'except' => ['prepend', 'append'],
    ])

    <x-slot:prepend>
        <x-dynamic-component
            :component="WireUi::component('button')"
            x-hold.click.delay.repeat.100ms="minus"
            x-bind:disabled="disableMinus"
            x-on:keydown.enter="minus"
            :icon="$leftIcon"
            primary
            flat
            squared
        />
    </x-slot:prepend>

    <x-wireui::inputs.element
        :attributes="$attrs
            ->except('class')
            ->class('text-center appearance-number-none')
            ->except(['wire:key', 'x-data'])
        "
        x-on:keydown.down.prevent="minus"
        x-on:keydown.up.prevent="plus"
        inputmode="numeric"
        type="number"
        x-ref="input"
    />

    <x-slot:append>
        <x-dynamic-component
            :component="WireUi::component('button')"
            x-hold.click.delay.repeat.100ms="plus"
            x-bind:disabled="disablePlus"
            x-on:keydown.enter="plus"
            :icon="$rightIcon"
            primary
            flat
            squared
        />
    </x-slot:append>
</x-inputs.wrapper>
