<span {{ $attributes->class([
    'outline-none inline-flex justify-center items-center group',
    $roundedClasses,
    $colorClasses,
    $sizeClasses,
]) }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            @class([$iconSizeClasses, 'shrink-0'])
        />
    @else
        {{ $label ?? $slot }}
    @endif
</span>
