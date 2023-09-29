@php
    $rootClasses = Arr::toCssClasses([
        'outline-none inline-flex justify-center items-center group',
        $roundedClasses,
        $colorClasses,
        $sizeClasses,
    ]);

    $iconClasses = Arr::toCssClasses([
        $iconSizeClasses,
        'shrink-0',
    ]);
@endphp

<span {{ $attributes->class($rootClasses) }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            :class="$iconClasses"
        />
    @else
        {{ $label ?? $slot }}
    @endif
</span>
