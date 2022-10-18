<span {{ $attributes->merge() }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            class="{{ $iconSize }} shrink-0"
        />
    @elseif (isset($prepend))
        {{ $prepend }}
    @endif

    {{ $label ?? $slot }}

    @if ($rightIcon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$rightIcon"
            class="{{ $iconSize }} shrink-0"
        />
    @elseif (isset($append))
        {{ $append }}
    @endif
</span>
