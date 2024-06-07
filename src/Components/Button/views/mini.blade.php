<{{ $tag }} {{ $attributes->class([
    'outline-none inline-flex justify-center items-center group hover:shadow-sm',
    'transition-all ease-in-out duration-200 focus:ring-2 focus:ring-offset-2',
    'focus:ring-offset-background-white dark:focus:ring-offset-background-dark',
    'disabled:opacity-80 disabled:cursor-not-allowed',
    Arr::toRecursiveCssClasses($colorClasses),
    $roundedClasses,
    $sizeClasses,
]) }}>
    <div class="shrink-0" {{ $spinnerRemove }}>
        @if ($icon)
            <x-dynamic-component
                :component="WireUi::component('icon')"
                :name="$icon"
                @class([$iconSizeClasses, 'shrink-0'])
            />
        @else
            {{ $label ?? $slot }}
        @endif
    </div>

    @if ($spinner)
        <x-wireui-icon::spinner
            :attributes="$spinner"
            @class([$iconSizeClasses, 'shrink-0 animate-spin'])
        />
    @endif
</{{ $tag }}>
