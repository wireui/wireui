@php
    $name = $name ?? $attributes->wire('model')->value();

    $rootClasses = Arr::toCssClasses([
        'soft-scrollbar' => Arr::get($typeClasses, 'soft-scrollbar', false),
        'hide-scrollbar' => Arr::get($typeClasses, 'hide-scrollbar', false),
        $spacing ?? Arr::get($typeClasses, 'spacing', 'p-4'),
        $zIndex  ?? Arr::get($typeClasses, 'z-index', 'z-50'),
        'fixed inset-0 overflow-y-auto',
    ]);

    $backdropClasses = Arr::toCssClasses([
        'fixed inset-0 bg-secondary-400 dark:bg-secondary-700 bg-opacity-60',
        'dark:bg-opacity-60 transform transition-opacity',
        $blurClasses => !$blurless,
    ]);

    $mainClasses = Arr::toCssClasses([
        'w-full min-h-full transform flex items-end justify-center mx-auto',
        $maxWidthClasses,
        $alignClasses,
    ]);
@endphp

<div class="{{ $rootClasses }}"
    x-data="wireui_modal({
        show: @toJs($show),
        @if ($attributes->wire('model')->value())
            model: @entangle($attributes->wire('model'))
        @endif
    })"
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
    wireui-modal>
    <div class="{{ $backdropClasses }}"
        x-show="show"
        x-on:click="close"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div class="{{ $mainClasses }}"
        x-show="show"
        x-on:click.self="close"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>
