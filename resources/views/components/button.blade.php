<button {{ $attributes->merge([
    'class' => $classes,
    'type'  => 'button'
]) }}
wire:loading.attr="disabled">
    @if ($icon)
        <x-dynamic-component
            :component="WireUiComponent::resolve('icon')"
            :name="$icon"
            class="w-4 h-4 shrink-0"
        />
    @endif

    {{ $label ?? $slot }}

    @if ($rightIcon)
        <x-dynamic-component
            :component="WireUiComponent::resolve('icon')"
            :name="$rightIcon"
            class="w-4 h-4"
        />
    @endif

    @if ($spinner)
        <svg class="animate-spin w-4 h-4"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            @if (preg_replace('/[^a-zA-Z]+/', '', $spinner))
                wire:target="{{ $spinner }}"
            @endif
            wire:loading.delay{{ $loadingDelay ? ".{$loadingDelay}":'' }}>
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @endif
</button>
