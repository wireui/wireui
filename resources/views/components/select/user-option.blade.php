<x-dynamic-component
    :component="WireUiComponent::resolve('select.option')"
    :data-label="$label"
    :value="$value"
    :disabled="$disabled"
    :readonly="$readonly"
    :option="$option"
>
    <div class="flex items-center gap-x-3">
        <img src="{{ data_get($option, 'img', $img) }}" class="shrink-0 h-6 w-6 rounded-full">

        {!! $label !!}
    </div>
</x-dynamic-component>
