@php
    $rootClasses = Arr::toCssClasses([
        'outline-none inline-flex justify-center items-center group hover:shadow-sm',
        'transition-all ease-in-out duration-200 focus:ring-2 focus:ring-offset-2',
        'focus:ring-offset-background-white dark:focus:ring-offset-background-dark',
        'disabled:opacity-80 disabled:cursor-not-allowed',
        Arr::get($colorClasses, 'base', ''),
        Arr::get($colorClasses, 'hover', ''),
        Arr::get($colorClasses, 'focus', ''),
        $roundedClasses,
        $sizeClasses,
    ]);

    $iconClasses = Arr::toCssClasses([
        $iconSizeClasses,
        'shrink-0',
    ]);
@endphp

<{{ $tag }} {{ $attributes->class($rootClasses) }}>
    <div class="shrink-0" {{ $spinnerRemove }}>
        @if ($icon)
            <x-dynamic-component
                :component="WireUi::component('icon')"
                :name="$icon"
                :class="$iconClasses"
            />
        @else
            {{ $label ?? $slot }}
        @endif
    </div>

    @if ($spinner)
        <x-wireui::icon.spinner
            {{ $spinner }}
            @class([$iconClasses, 'animate-spin'])
        />
    @endif
</{{ $tag }}>
