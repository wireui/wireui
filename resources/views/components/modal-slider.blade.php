@php($name = $name ?? $attributes->wire('model')->value())

<div class="fixed inset-0 overflow-y-auto {{ $zIndex }}"
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
     {{ $attributes
         ->whereDoesntStartWith('wire:model')
         ->whereStartsWith(['x-on:', '@', 'wire:']) }}
     style="display: none"
     x-cloak
     x-show="show"
     wireui-modal>

    <div
        @class([
            'fixed inset-0 bg-secondary-400 dark:bg-secondary-700 bg-opacity-60',
            'dark:bg-opacity-60 transform transition-opacity',
            $blur => (bool) $blur
        ])
        x-show="show"
        x-on:click="close"
        x-transition:enter="ease-in-out duration-500"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in-out duration-500"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div
                    x-show="show"
                    x-on:click.self="close"
                    x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="pointer-events-auto relative w-screen {{ $maxWidth }}"
                >
                    <div class="flex h-full flex-col divide-y divide-secondary-200 dark:divide-secondary-500 bg-white dark:bg-secondary-800 shadow-xl">
                        <div class="flex min-h-0 flex-1 flex-col overflow-y-scroll py-6">

                            <div class="px-4 sm:px-6 pb-6 border-b dark:border-0">
                                <div class="flex items-start justify-between">
                                    @isset($header)
                                        {{ $header }}
                                    @else
                                        <h2 class="text-lg font-medium text-gray-900 dark:text-secondary-400" id="slide-over-title">{{ $title }}</h2>
                                        <div class="ml-3 flex h-7 items-center">
                                            <button class="focus:outline-none p-1 focus:ring-2 focus:ring-secondary-200 rounded-full text-secondary-300"
                                                    x-on:click="close"
                                                    tabindex="-1">
                                                <x-dynamic-component
                                                    :component="WireUi::component('icon')"
                                                    name="x"
                                                    class="w-5 h-5"
                                                />
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="relative mt-2 flex-1 px-4 sm:px-6 dark:text-secondary-400 {{ $spacing }}">
                                {{ $slot }}
                            </div>

                        </div>

                        @isset($footer)
                            {{ $footer }}
                        @endisset

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

