<div {{ $attributes->class([
    'shrink-0 inline-flex items-center justify-center overflow-hidden',
    data_get($colorClasses, 'border', '') => !$borderless,
    data_get($colorClasses, 'label', '') => !$src,
    $borderClasses => !$borderless,
    $sizeClasses => !$src,
    $roundedClasses,
]) }}>
    @if ($label)
        <span {{ WireUi::extractAttributes($label)->class([
            data_get($iconSizeClasses, 'label', 'text-base'),
            'font-medium text-white dark:text-gray-200',
        ]) }}>
            {{ $label }}
        </span>
    @elseif ($src)
        <img
            alt="{{ $alt }}"
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
                data_get($iconSizeClasses, 'icon', 'w-7 h-7'),
                'text-white dark:text-gray-200 shrink-0',
            ])
        />
    @endif
</div>
