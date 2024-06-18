@props(['margin' => false, 'rootClass' => null])

<div
    x-cloak
    style="display: none;"
    :style="positionable.styles"
    x-show="positionable.state"
    x-ref="popover"
    x-on:click.outside.prevent="positionable.close()"
    x-on:keydown.escape.window="positionable.handleEscape()"
    @class([
        'fixed inset-0 z-20 flex sm:w-full sm:justify-end items-end sm:z-10 sm:absolute sm:inset-auto',
        'pointer-events-none transition-all ease-linear duration-150',
        'sm:top-0 sm:right-0',
        $rootClass,
    ])
>
    <div
        x-show="positionable.state"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-on:click="positionable.close()"
        aria-hidden="true"
        @class([
            'fixed inset-0 transition-opacity bg-secondary-400 bg-opacity-60 sm:hidden',
            'pointer-events-auto dark:bg-secondary-700 dark:bg-opacity-60',
        ])
    ></div>

    <div
        x-show="positionable.state"
        tabindex="-1"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        {{ $attributes->class([
            'w-full rounded-t-md sm:rounded-xl border border-secondary-200 bg-white shadow-lg',
            'dark:bg-secondary-800 dark:border-secondary-600 transition-all relative overflow-hidden',
            'pointer-events-auto',
        ]) }}
    >
        {{ $slot }}
    </div>
</div>
