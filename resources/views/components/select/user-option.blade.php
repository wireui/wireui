<x-dynamic-component
    :component="WireUiComponent::resolve('select.option')"
    :data-label="$label"
    :value="$value"
    :disabled="$disabled"
    :readonly="$readonly"
    :option="$option"
>
    <div>
        @if ($subtitle)
            <div class="flex items-center space-x-3">
                <img src="{{ data_get($option, 'img', $img) }}" class="shrink-0 h-6 w-6 rounded-full">

                <div>
                    {!! $label !!}
                    <div class="text-xs text-gray-400">{!! $subtitle !!}</div>
                </div>
            </div>
        @else
            <div class="flex items-center gap-x-3">
                <img src="{{ data_get($option, 'img', $img) }}" class="shrink-0 h-6 w-6 rounded-full">

                {!! $label !!}
            </div>
        @endif
    </div>
</x-dynamic-component>
