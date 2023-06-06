<div {{ $attributes->class($getRootClasses()) }}>
    @if ($label)
        <span class="{{ $getLabelClasses() }}">
            {{ $label }}
        </span>
    @elseif ($src)
        <img
            src="{{ $src }}"
            class="{{ $getImageClasses() }}"
        />
    @else
        <x-icon
            name="{{ $icon ?? 'user' }}"
            class="{{ $getIconClasses() }}"
            solid
        />
    @endif
</div>
