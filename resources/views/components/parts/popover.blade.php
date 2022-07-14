@props(['margin' => false, 'rootClass' => null])

<div class="fixed inset-0 z-20 sm:z-10 sm:absolute sm:inset-auto transition-all ease-linear duration-150 {{ $rootClass }}"
     :class="{
        'sm:left-0': position.x === 'left',
        'sm:right-0': position.x === 'right',
        'sm:top-0 {{ $margin ? 'sm:mt-16' : 'sm:mt-11' }}': position.y === 'bottom',
        'sm:bottom-0 {{ $margin ? 'sm:mb-16' : 'sm:mb-11' }}': position.y === 'top',
    }"
     style="display: none"
     x-cloak
     x-show="popover"
     x-ref="popover"
     x-on:click.outside="close"
     x-on:keydown.escape.window="handleEscape">
    <div class="flex items-end justify-center min-h-screen sm:min-h-max sm:items-start">
        <div class="fixed inset-0 bg-secondary-400 bg-opacity-60 transition-opacity sm:hidden
                    dark:bg-secondary-700 dark:bg-opacity-60"
             x-show="popover"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             x-on:click="close"
             aria-hidden="true">
        </div>

        <div
            {{ $attributes->class([
                'w-full rounded-t-md sm:rounded-xl border border-secondary-200 bg-white shadow-lg',
                'dark:bg-secondary-800 dark:border-secondary-600 transition-all relative overflow-hidden',
            ]) }}
            x-show="popover"
            tabindex="-1"
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
