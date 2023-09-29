@php
    $rootClasses = Arr::toCssClasses([
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
    ]);

    $iconClasses = Arr::toCssClasses([
        $iconSizeClasses,
        'shrink-0',
    ]);
@endphp

<{{ $tag }} {{ $attributes->class($rootClasses) }}>
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
            {{ $spinnerRemove->merge([
                'name' => $rightIcon,
                'class' => $iconClasses,
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
            @class([$iconClasses, 'animate-spin'])
        />
    @endif
</{{ $tag }}>

