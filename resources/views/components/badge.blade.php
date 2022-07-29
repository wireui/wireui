<span {{ $attributes->class($badgeClasses) }}>

    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            class="{{ $iconSize }}"
        />
    @endif

    @if ($pulse)
        <span class="flex relative h-2 w-2 mr-2">
            <span class="{{ $pulsePingColor }}"></span>
            <span class="{{ $pulseColor }}"></span>
        </span>
    @endif

    <span>{{ $title ?? $slot }}</span>

    @isset ($dismissible)
        {{ $dismissible }}
    @endif
</span>
