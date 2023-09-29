@php
    $rootClasses = Arr::toCssClasses([
        'font-semibold text-center inline-block',
        $underlineClasses,
        $colorClasses,
        $sizeClasses,
    ]);
@endphp

<{{ $tag }} {{ $attributes->class($rootClasses) }}>
    {{ $label ?? $slot }}
</{{ $tag }}>
