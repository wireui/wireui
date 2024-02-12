<span {{ $attributes->class([
    'outline-none inline-flex justify-center items-center group',
    'w-full' => $full,
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
    @elseif (isset($prepend))
        <div {{ $prepend->attributes }}>
            {{ $prepend }}
        </div>
    @endif

    {{ $label ?? $slot }}

    @if ($rightIcon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$rightIcon"
            @class([$iconSizeClasses, 'shrink-0'])
        />
    @elseif (isset($append))
        <div {{ $append->attributes }}>
            {{ $append }}
        </div>
    @endif
</span>
