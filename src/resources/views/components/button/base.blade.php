<{{ $tag }} {{ $attributes->class($getRootClasses()) }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            class="{{ $getIconClasses() }}"
            :name="$icon"
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
                'class' => $getIconClasses(),
            ]) }}
        />
    @elseif (isset($append))
        <div {{ $append->attributes }} {{ $spinnerRemove }}>
            {{ $append }}
        </div>
    @endif

    @if ($spinner)
        <x-wireui::icons.spinner
            class="animate-spin {{ $getIconClasses() }}"
            {{ $spinner }}
        />
    @endif
</{{ $tag }}>

