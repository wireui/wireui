<span {{ $attributes->class($getRootClasses()) }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            class="{{ $getIconClasses() }}"
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
            class="{{ $getIconClasses() }}"
        />
    @elseif (isset($append))
        <div {{ $append->attributes }}>
            {{ $append }}
        </div>
    @endif
</span>
