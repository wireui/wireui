<div
    x-data="wireui_dropdown"
    x-props="{
        position: '{{ $position }}',
    }"
    class="relative inline-block text-left"
    x-on:click.outside="positionable.close()"
    x-on:keydown.escape.window="positionable.close()"
    {{ $attributes->only('wire:key') }}
>
    <div
        x-ref="triggerContainer"
        x-on:click="positionable.toggle()"
        class="cursor-pointer focus:outline-none"
    >
        @if (isset($trigger))
            {{ $trigger }}
        @else
            <x-dynamic-component
                :component="WireUi::component('icon')"
                :name="$icon"
                @class([
                    'dark:hover:text-secondary-600 transition duration-150 ease-in-out',
                    'w-4 h-4 text-secondary-500 hover:text-secondary-700',
                ])
            />
        @endif
    </div>

    <div
        x-ref="popover"
        x-show="positionable.state"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        {{ $attributes->except('wire:key')->class([
            'z-30 absolute whitespace-nowrap',
            'transition-all transform',
            $widthClasses,
        ]) }}
        style="display: none;"
        @unless($persistent) x-on:click="positionable.close()" @endunless
    >
        <div @class([
            'soft-scrollbar overflow-auto' => $height !== WireUi\Enum\Packs\Height::AUTO,
            'shadow-lg p-1 bg-white dark:bg-secondary-800 dark:border-secondary-600',
            'relative border border-secondary-200 rounded-lg',
            $heightClasses,
        ])>
            {{ $slot }}
        </div>
    </div>
</div>
