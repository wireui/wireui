@php $model = $attributes->wire('model'); @endphp

<div class="fixed inset-0 overflow-y-auto {{ $zIndex }}"
    x-data="wireui_modal({
        model: @entangle($attributes->wire('model'))
    })"
    x-on:keydown.escape.window="close"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="previousFocusable().focus()"
    x-on:open-modal:{{ Str::kebab((string)$model) }}.window="show = true"
    {{ $attributes->whereStartsWith(['x-on:', '@']) }}
    style="display: none"
    x-show="show">
    <div class="flex items-end {{ $align }} min-h-screen justify-center w-full
                relative transform transition-all {{ $spacing }}"
        style="min-height: -webkit-fill-available; min-height: fill-available;">
        <div @class([
                'fixed inset-0 bg-secondary-400 dark:bg-secondary-700 bg-opacity-60',
                'dark:bg-opacity-60 transform transition-opacity',
                $blur => (bool) $blur
            ])
            x-show="show"
            x-on:click="close"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
        </div>

        <div class="w-full {{ $maxWidth }} z-10"
            x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            {{ $slot }}
        </div>
    </div>
</div>
