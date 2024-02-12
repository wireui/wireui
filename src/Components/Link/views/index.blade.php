<{{ $tag }} {{ $attributes->class([
    'font-semibold text-center inline-block',
    $underlineClasses,
    $colorClasses,
    $sizeClasses,
]) }}>
    {{ $label ?? $slot }}
</{{ $tag }}>
