<x-inputs.wrapper
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'class'])"
    x-data="wireui_inputs_currency"
    :x-props="WireUi::phpToJs([
        'emitFormatted' => $emitFormatted,
        'thousands'     => $thousands,
        'decimal'       => $decimal,
        'precision'     => $precision,
        'wireModel'     => WireUi::wireModel(isset($__livewire) ? $this : null, $attrs),
    ])"
>
    @include('wireui::form.wrapper.slots')

    <x-wireui::inputs.element
        x-model="input"
        x-on:blur="onBlur"
        :attributes="$attrs
            ->whereDoesntStartWith(['wire:model', 'wire:key'])
            ->except(['type', 'wire:key', 'x-data', 'class'])"
    />
</x-inputs.wrapper>
