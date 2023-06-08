<span {{ $attributes->class($getRootClasses()) }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            class="{{ $getIconClasses() }}"
        />
    @else
        {{ $label ?? $slot }}
    @endif
</span>
