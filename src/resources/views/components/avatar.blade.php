@php
    $rootClasses = Arr::toCssClasses([
        'shrink-0 inline-flex items-center justify-center overflow-hidden',
        Arr::get($colorClasses, 'border', '') => !$borderless,
        Arr::get($colorClasses, 'label', '') => !$src,
        $borderClasses => !$borderless,
        $sizeClasses => !$src,
        $roundedClasses,
        $sizeClasses,
    ]);

    $labelClasses = Arr::toCssClasses([
        Arr::get($iconSizeClasses, 'label', 'text-base'),
        'font-medium text-white dark:text-gray-200',
    ]);

    $imageClasses = Arr::toCssClasses([
        'shrink-0 object-cover object-center',
        $roundedClasses,
        $sizeClasses,
    ]);

    $iconClasses = Arr::toCssClasses([
        Arr::get($iconSizeClasses, 'icon', 'w-7 h-7'),
        'text-white dark:text-gray-200 shrink-0',
    ]);
@endphp

<div {{ $attributes->class($rootClasses) }}>
    @if ($label)
        @if (check_slot($label))
            <div {{ $label->attributes->class($labelClasses) }}>
                {{ $label }}
            </div>
        @else
            <span class="{{ $labelClasses }}">
                {{ $label }}
            </span>
        @endif
    @elseif ($src)
        <img
            src="{{ $src }}"
            class="{{ $imageClasses }}"
        />
    @else
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon ?? 'user'"
            solid
            :class="$iconClasses"
        />
    @endif
</div>
