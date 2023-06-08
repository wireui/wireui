<div {{ $attributes->class($getRootClasses()) }}>
    @if ($label)
        @if ($checkSlot($label))
            <div {{ $label->attributes->class($getLabelClasses()) }}>
                {{ $label }}
            </div>
        @else
            <span class="{{ $getLabelClasses() }}">
                {{ $label }}
            </span>
        @endif
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
