@php($name = $name ?? $attributes->wire('model')->value())

<div x-data="wireui_modal({
        show: @json($show),
        @if ($attributes->wire('model')->value())
            model: @entangle($attributes->wire('model'))
        @endif
    })"
    @class([
        'soft-scrollbar' => data_get($typeClasses, 'soft-scrollbar', false),
        'hide-scrollbar' => data_get($typeClasses, 'hide-scrollbar', false),
        $zIndex  ?? data_get($typeClasses, 'z-index', 'z-40'),
        'fixed inset-0 overflow-y-auto',
    ])
    x-on:keydown.escape.window="handleEscape"
    x-on:keydown.tab.prevent="handleTab"
    x-on:keydown.shift.tab.prevent="handleShiftTab"
    x-on:open-wireui-modal:{{ Str::kebab($name) }}.window="open"
    x-on:close-wireui-modal:{{ Str::kebab($name) }}.window="close"
    {{ $attributes
        ->whereDoesntStartWith('wire:model')
        ->whereStartsWith(['x-on:', '@', 'wire:']) }}
    style="display: none"
    x-cloak
    x-show="show"
    wireui-modal
>
    <div
        x-show="show"
        @class([
            'fixed inset-0 bg-secondary-400 dark:bg-secondary-700 bg-opacity-60',
            'dark:bg-opacity-60 transform transition-opacity',
            $blurClasses => !$blurless,
        ])
        @unless($persistent) x-on:click="close" @endunless
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div
        x-show="show"
        @class([
            'w-full min-h-full transform flex items-end justify-center mx-auto',
            $spacing ?? data_get($typeClasses, 'spacing', 'p-4'),
            $alignClasses,
            $widthClasses,
        ])
        @unless($persistent) x-on:click.self="close" @endunless
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>
</div>
