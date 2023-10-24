@php($name = $name ?? $attributes->wire('model')->value())

<div class="fixed inset-0 overflow-y-auto {{ $spacing }} {{ $zIndex }}"
    x-data="wireui_modal({
        show: @toJs($show),
        @if ($attributes->wire('model')->value())
            model: @entangleable($attributes->wire('model'))
        @endif
    })"
    x-on:keydown.escape.window="handleEscape"
    x-on:keydown.tab.prevent="handleTab"
    x-on:keydown.shift.tab.prevent="handleShiftTab"
    x-on:open-wireui-modal:{{ Str::kebab($name) }}.window="open"
    {{ $attributes
        ->whereDoesntStartWith('wire:model')
        ->whereStartsWith(['x-on:', '@', 'wire:']) }}
    style="display: none"
    x-cloak
    x-show="show"
    wireui-modal>
    <div @class([
            'fixed inset-0 bg-secondary-400 dark:bg-secondary-700 bg-opacity-60',
            'dark:bg-opacity-60 transform transition-opacity',
            $blur => (bool) $blur
        ])
        x-show="show"
        @unless($persistent)
            x-on:click="close"
        @endunless
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div class="w-full min-h-full transform flex items-end justify-center mx-auto {{ $align }} {{ $maxWidth }}"
        x-show="show"
        @unless($persistent)
            x-on:click.self="close"
        @endunless
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>
