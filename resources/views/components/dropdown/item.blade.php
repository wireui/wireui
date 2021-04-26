<a {{ $attributes->merge(['class' => $getClasses()]) }}>
    @if ($icon)
        <x-icon :name="$icon" class="w-5 h-5 mr-2" />
    @endif

    {{ $label ?? $slot }}
</a>
