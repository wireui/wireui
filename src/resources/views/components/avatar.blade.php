<div {{ $attributes->class([
    'shrink-0 inline-flex items-center justify-center overflow-hidden',
    Arr::get($colorClasses, 'border', '') => !$borderless,
    Arr::get($colorClasses, 'label', '') => !$src,
    $borderClasses => !$borderless,
    $sizeClasses => !$src,
    $roundedClasses,
    $sizeClasses,
]) }}>
    @if ($label)
        @if (check_slot($label))
            <div {{ $label->attributes->class([
                Arr::get($iconSizeClasses, 'label', 'text-base'),
                'font-medium text-white dark:text-gray-200',
            ]) }}>
                {{ $label }}
            </div>
        @else
            <span @class([
                Arr::get($iconSizeClasses, 'label', 'text-base'),
                'font-medium text-white dark:text-gray-200',
            ])>
                {{ $label }}
            </span>
        @endif
    @elseif ($src)
        <img
            src="{{ $src }}"
            @class([
                'shrink-0 object-cover object-center',
                $roundedClasses,
                $sizeClasses,
            ])
        />
    @else
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon ?? 'user'"
            solid
            @class([
                Arr::get($iconSizeClasses, 'icon', 'w-7 h-7'),
                'text-white dark:text-gray-200 shrink-0',
            ])
        />
    @endif
</div>
