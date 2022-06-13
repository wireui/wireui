<div x-data="wireui_color_picker({
    @if ($attributes->wire('model')->value())
        wireModel: @entangle($attributes->wire('model')),
    @endif

    @if ($colors)
        colors: @js($getColors())
    @endif
})">
    <x-input
        x-model="selected"
        x-bind:class="{ 'pl-8': selected }"
        x-on:input="setColor($event.target.value)"
        x-ref="input"
        :prefix="null"
        :icon="null"
        {{ $attributes }}>
        <x-slot name="prefix">
            <template x-if="selected">
                <div
                    class="w-4 h-4 rounded shadow border"
                    :style="{ 'background-color': selected }"
                ></div>
            </template>
        </x-slot>

        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                <x-button
                    class="h-full rounded-r-md"
                    primary
                    flat
                    squared
                    x-on:click="toggle"
                    trigger>
                    <x-icon
                        class="
                            w-4 h-4 group-focus:text-primary-700 text-gray-400 dark:text-gray-600
                            dark:group-hover:text-gray-500 dark:group-focus:text-primary-500
                        "
                        :name="$rightIcon"
                    />
                </x-button>

                <div class="fixed inset-0 z-20 sm:absolute sm:inset-auto sm:top-10 sm:mt-1 sm:right-0"
                    x-cloak
                    style="display: none;"
                    x-show="state"
                    x-on:click.outside="close"
                    x-on:keydown.escape.window="close">
                    <div class="flex items-end justify-center min-h-screen sm:min-h-0 sm:items-start"
                        style="min-height: -webkit-fill-available; min-height: fill-available;">
                        <div class="fixed inset-0 bg-secondary-400 bg-opacity-60 transition-opacity
                                    sm:hidden dark:bg-secondary-700 dark:bg-opacity-60"
                            x-show="state"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            x-on:click="close"
                            aria-hidden="true">
                        </div>

                        <div class="w-full rounded-t-md border border-secondary-200 bg-white shadow-lg
                                    dark:bg-secondary-800 dark:border-secondary-600 relative
                                    max-h-56 overflow-y-auto soft-scrollbar py-3 px-2 sm:py-2 sm:px-1 sm:w-72 sm:rounded-xl"
                            x-show="state"
                            tabindex="-1"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                            <div class="flex flex-wrap items-center justify-center gap-1 sm:gap-0.5 max-w-[18rem] mx-auto">
                                <span class="sr-only">dropdown-open</span>

                                <template x-for="(color, index) in colors" :key="index">
                                    <button class="
                                            w-6 h-6 rounded shadow-lg border hover:scale-125 transition-all ease-in-out duration-100 cursor-pointer
                                            hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-600 sdark:focus:ring-gray-400
                                            dark:border-0 dark:hover:ring-2 dark:hover:ring-gray-400
                                        "
                                        :style="{ 'background-color': color.value }"
                                        x-on:click="select(color.value)"
                                        :title="color.name"
                                        type="button">
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-input>
</div>
