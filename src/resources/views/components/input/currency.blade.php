<x-wrapper
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'class'])"
    x-data="wireui_inputs_currency({
        isBlur: @boolean($attrs->wire('model')->hasModifier('blur')),
        model:  @entangle($attrs->wire('model')),
        emitFormatted: @boolean($emitFormatted),
        thousands: '{{ $thousands }}',
        decimal:   '{{ $decimal }}',
        precision:  {{ $precision }},
    })"
>
    @include('wireui::components.wrapper.slots')

    <x-wireui::wrapper.input.element
        x-model="input"
        x-on:input="mask($event.target.value)"
        x-on:blur="emitInput($event.target.value)"
        :attributes="$attrs
            ->whereDoesntStartWith(['wire:model', 'wire:key'])
            ->except(['type', 'wire:key', 'x-data', 'class'])"
    />
</x-wrapper>
