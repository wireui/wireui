<{{ $tag }} {{ $attributes->class($getRootClasses()) }}>
    <div class="shrink-0" {{ $spinnerRemove }}>
        @if ($icon)
            <x-dynamic-component
                :component="WireUi::component('icon')"
                class="{{ $getIconClasses() }}"
                :name="$icon"
            />
        @else
            {{ $label ?? $slot }}
        @endif
    </div>

    @if ($spinner)
        <x-wireui::icons.spinner
            class="animate-spin {{ $getIconClasses() }}"
            {{ $spinner }}
        />
    @endif
</{{ $tag }}>
