<x-wrapper
    :data="$wrapperData"
    :right-icon="$rightIcon"
    :attributes="$attrs->only(['wire:key', 'class'])"
    x-data="wireui_inputs_number({
        disabled: {{ json_encode($disabled) }},
        readonly: {{ json_encode($readonly) }},
    })"
>
    @include('wireui::components.wrapper.slots', [
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
            :icon="$icon"
            flat
        />
    </x-slot:prepend>

    <x-wireui::wrapper.input.element
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
            :color="$color ?? 'primary'"
            :rounded="Arr::get($roundedClasses, 'append', '')"
            x-bind:disabled="disablePlus"
            x-on:keydown.enter="plus"
            :icon="$rightIcon"
            flat
        />
    </x-slot:append>
</x-wrapper>
