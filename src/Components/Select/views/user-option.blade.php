<x-dynamic-component
    :component="WireUi::component('select.option')"
    :attributes="$attributes->except(['src'])"
    :label="$label" :option="$option" :description="$description"
>
    <div class="flex items-center gap-x-3">
        @if ($option || $src)
            <img src="{{ data_get($option, 'src', $src) }}" class="object-cover w-6 h-6 rounded-full shrink-0">
        @endif
        <span @class(['text-sm' => (bool) $description])>
            {{ $label }}

            @if ($description)
                <div class="text-xs text-gray-400">{{ $description }}</div>
            @endif
        </span>
    </div>
</x-dynamic-component>
