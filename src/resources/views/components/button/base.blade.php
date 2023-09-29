<{{ $tag }} {{ $attributes->class([
    'outline-none inline-flex justify-center items-center group hover:shadow-sm',
    'focus:ring-offset-background-white dark:focus:ring-offset-background-dark',
    'transition-all ease-in-out duration-200 focus:ring-2',
    'disabled:opacity-80 disabled:cursor-not-allowed',
    // 'group-[.wrapper-prepend-slot]/prepend:rounded-l-[4px]',
    // 'group-[.wrapper-append-slot]/append:rounded-r-[4px]',
    Arr::get($colorClasses, 'base', ''),
    Arr::get($colorClasses, 'hover', ''),
    Arr::get($colorClasses, 'focus', ''),
    'w-full' => $full,
    $roundedClasses,
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
            {{ $spinnerRemove->class([
                $iconSizeClasses, 'shrink-0',
            ])->merge([
                'name' => $rightIcon,
            ]) }}
        />
    @elseif (isset($append))
        <div {{ $append->attributes }} {{ $spinnerRemove }}>
            {{ $append }}
        </div>
    @endif

    @if ($spinner)
        <x-wireui::icon.spinner
            {{ $spinner }}
            @class([$iconSizeClasses, 'shrink-0 animate-spin'])
        />
    @endif
</{{ $tag }}>

