@php
    $rootClasses = Arr::toCssClasses([
        'outline-none inline-flex justify-center items-center group',
        'w-full' => $full,
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
            :class="$iconClasses"
        />
    @elseif (isset($append))
        <div {{ $append->attributes }}>
            {{ $append }}
        </div>
    @endif
</span>
