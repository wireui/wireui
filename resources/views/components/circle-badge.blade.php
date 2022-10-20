<span {{ $attributes->merge() }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            class="{{ $iconSize }} shrink-0"
        />
    @else
        {{ $label ?? $slot }}
    @endif
</span>
