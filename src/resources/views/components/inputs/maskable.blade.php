<x-inputs.wrapper
    :x-data="WireUi::alpine('wireui_inputs_maskable', [
        'isBlur'        => $attrs->wire('model')->hasModifier('blur'),
        'model'         => null,
        'emitFormatted' => $emitFormatted,
        'mask'          => $mask,
    ])"
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class'])"
>
    @include('wireui::form.wrapper.slots')

    <x-wireui::inputs.element
        x-model="input"
        x-on:input="onInput($event.target.value)"
        x-on:blur="emitInput"
        :attributes="$attrs
            ->except('class')
            ->whereDoesntStartWith(['wire:model', 'x-model', 'wire:key'])
        "
    />
</x-inputs.wrapper>
