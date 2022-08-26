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
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ $pulsePingColor }}"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 {{ $pulseColor }}"></span>
        </span>
    @endif

    <span>{{ $title ?? $slot }}</span>

    @if ($rightIcon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$rightIcon"
            class="ml-1 {{ $iconSize }}"
        />
    @endif

    @isset ($dismissible)
        {{ $dismissible }}
    @endif
</span>
