<span {{ $attributes->merge() }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            class="{{ $iconSize }} shrink-0"
        />
    @elseif ($prepend)
        {{ $prepend }}
    @endif

    {{ $label ?? $slot }}

    @if ($rightIcon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$rightIcon"
            class="{{ $iconSize }} shrink-0"
        />
    @elseif ($append)
        {{ $append }}
    @endif
</span>
