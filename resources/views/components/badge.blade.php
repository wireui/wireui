<span {{ $attributes->class($badgeClasses) }}>
    @if ($pulse)
        <span class="flex absolute h-2 w-2 mr-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ $pulsePingColor }}"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 {{ $pulseColor }}"></span>
        </span>
    @endif

    <span>{{ $title ?? $slot }}</span>

    @if($dismissible)
        {{ $dismissible }}
    @endif
</span>
