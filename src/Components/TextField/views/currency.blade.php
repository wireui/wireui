<x-wrapper
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'class'])"
    :x-data="WireUi::alpine('wireui_inputs_currency', [
        'isBlur'        => $attrs->wire('model')->hasModifier('blur'),
        'model'         => $attrs->wire('model'),
        'emitFormatted' => $emitFormatted,
        'thousands'     => $thousands,
        'decimal'       => $decimal,
        'precision'     => $precision,
    ])"
>
    @include('wireui-wrapper::components.slots')

    <x-wireui-wrapper::element
        x-model="input"
        x-on:input="mask($event.target.value)"
        x-on:blur="emitInput($event.target.value)"
        :attributes="$attrs
            ->whereDoesntStartWith(['wire:model'])
            ->except(['type', 'wire:key', 'x-data', 'class'])"
    />
</x-wrapper>
