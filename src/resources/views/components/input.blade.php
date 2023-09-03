@php($attrs = $attributes)
@php($invalidated = $invalidated ?: $errors->has($name))

<x-inputs.wrapper
    :id="$id"
    :name="$name"
    :icon="$icon"
    :right-icon="$rightIcon"
    :validated="$validated && !$invalidated"
    :invalidated="$invalidated"
    :disabled=" (bool) $disabled"
    :readonly=" (bool) $readonly"
    :errorless="(bool) $errorless"
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

    <x-wireui::inputs.element {{ $attrs }} />
</x-inputs.wrapper>
