<button {{ $attributes->merge([
    'class' => $classes,
    'type'  => 'button'
]) }}
wire:loading.attr="disabled">
    @if ($icon)
        <x-icon :name="$icon" class="w-4 h-4" />
    @endif

    {{ $label ?? $slot }}

    @if ($rightIcon)
        <x-icon :name="$rightIcon" class="w-4 h-4" />
    @endif
</button>
