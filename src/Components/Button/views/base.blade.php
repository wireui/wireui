<{{ $tag }} {{ $attributes->class([
    'outline-none inline-flex justify-center items-center group hover:shadow-sm',
    'focus:ring-offset-background-white dark:focus:ring-offset-background-dark',
    'transition-all ease-in-out duration-200 focus:ring-2',
    'disabled:opacity-80 disabled:cursor-not-allowed',
    Arr::toRecursiveCssClasses($colorClasses),
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
        @php($spinnerRemove = $spinnerRemove->merge([
            'name' => $rightIcon,
            'class' => "{$iconSizeClasses} shrink-0",
        ]))
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :attributes="$spinnerRemove"
        />
    @elseif (isset($append))
        <div {{ $append->attributes }} {{ $spinnerRemove }}>
            {{ $append }}
        </div>
    @endif

    @if ($spinner)
        <x-wireui-icon::spinner
            :attributes="$spinner"
            @class([$iconSizeClasses, 'shrink-0 animate-spin'])
        />
    @endif
</{{ $tag }}>

