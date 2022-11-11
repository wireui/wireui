@php
    $tag = $href ? 'a' : 'button';

    $defaultAttributes = [
        'wire:loading.attr'  => 'disabled',
        'wire:loading.class' => '!cursor-wait',
    ];

    $href === null
        ? $defaultAttributes['type'] = 'button'
        : $defaultAttributes['href'] = $href;
@endphp

<{{ $tag }} {{ $attributes->merge($defaultAttributes) }}>
    <div @if($spinner)
            @if (preg_replace('/[^a-zA-Z]+/', '', $spinner))
                wire:target="{{ $spinner }}"
            @endif
            wire:loading.remove
        @endif>
        @if ($icon)
            <x-dynamic-component
                :component="WireUi::component('icon')"
                :name="$icon"
                class="{{ $iconSize }} shrink-0"
            />
        @else
            {{ $label ?? $slot }}
        @endif
    </div>

    @if ($spinner)
        <svg class="animate-spin {{ $iconSize }} shrink-0"
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
</{{ $tag }}>
