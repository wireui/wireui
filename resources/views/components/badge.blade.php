<span {{ $attributes }}>
    @if ($icon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$icon"
            class="{{ $iconSize }} shrink-0"
        />
    @elseif (isset($prepend))
        <div {{ $prepend->attributes }}>{{ $prepend }}</div>
    @endif

    {{ $label ?? $slot }}

    @if ($rightIcon)
        <x-dynamic-component
            :component="WireUi::component('icon')"
            :name="$rightIcon"
            class="{{ $iconSize }} shrink-0"
        />
    @elseif (isset($append))
        <div {{ $append->attributes }}>{{ $append }}</div>
    @endif
</span>
