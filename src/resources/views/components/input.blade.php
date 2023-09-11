<x-inputs.wrapper
    :id="$id"
    :name="$name"
    :icon="$icon"
    :right-icon="$rightIcon"
    :invalidated="$invalidated"
    :with-validation-colors="$withValidationColors"
    :disabled="  (bool) $disabled"
    :readonly="  (bool) $readonly"
    :errorless=" (bool) $errorless"
    :borderless="(bool) $borderless"
    :shadowless="(bool) $shadowless"
    :attributes="$attributes->only('wire:key')"
>
    @foreach(array_filter([
        'label'       => $label,
        'corner'      => $corner,
        'prefix'      => $prefix,
        'suffix'      => $suffix,
        'description' => $description,
        'prepend'     => isset($prepend) ? $prepend : false,
        'append'      => isset($append)  ? $append  : false,
    ]) as $key => $value)
        @slot($key, $value, WireUi::extractAttributes($value)->getAttributes())
    @endforeach

    <x-wireui::inputs.element :attributes="$attributes->except('wire:key')" />
</x-inputs.wrapper>
