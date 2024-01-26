<x-wrapper
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class'])"
    :x-data="WireUi::alpine('wireui_inputs_maskable', [
        'isBlur'        => $attrs->wire('model')->hasModifier('blur'),
        'model'         => $attrs->wire('model'),
        'emitFormatted' => $emitFormatted,
        'mask'          => $mask,
    ])"
>
    @include('wireui-wrapper::components.slots')

    <x-wireui-wrapper::element
        x-model="input"
        x-on:input="onInput($event.target.value)"
        x-on:blur="emitInput"
        :attributes="$attrs
            ->whereDoesntStartWith(['wire:model', 'x-model'])
            ->except(['class', 'wire:key'])
        "
    />
</x-wrapper>
