<div x-data="wireui_color_picker({
    colorNameAsValue: @boolean($colorNameAsValue),

    @if ($attributes->wire('model')->value())
        wireModifiers: @js($attributes->wireModifiers()),
        wireModel: @entangle($attributes->wire('model')),
    @endif

    @if ($colors)
        colors: @js($getColors())
    @endif
})" {{ $attributes->only(['class', 'wire:key'])->class('relative') }}>
    <x-dynamic-component
        {{ $attributes->except(['class', 'wire:key'])->whereDoesntStartWith('wire:model') }}
        :component="WireUi::component('input')"
        x-model="{{ $colorNameAsValue ? 'selected.name' : 'selected.value' }}"
        x-bind:class="{ 'pl-8': selected.value }"
        x-on:input="setColor($event.target.value)"
        x-ref="input"
        :label="$label"
        :prefix="null"
        :icon="null">
        <x-slot name="prefix">
            <template x-if="selected.value">
                <div
                    class="w-4 h-4 rounded shadow border"
                    :style="{ 'background-color': selected.value }"
                ></div>
            </template>
        </x-slot>

        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                <x-dynamic-component
                    :component="WireUi::component('button')"
                    class="h-full rounded-r-md"
                    primary
                    flat
                    squared
                    x-on:click="toggle"
                    trigger>
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        class="
                            w-4 h-4 group-focus:text-primary-700 text-gray-400 dark:text-gray-600
                            dark:group-hover:text-gray-500 dark:group-focus:text-primary-500
                        "
                        :name="$rightIcon"
                    />
                </x-dynamic-component>
            </div>
        </x-slot>
    </x-dynamic-component>

    <x-wireui::parts.popover
        :margin="(bool) $label"
        class="
            max-h-56 py-3 px-2 sm:py-2 sm:px-1 sm:w-72 sm:rounded-xl
            overflow-y-auto soft-scrollbar border border-secondary-200
        ">
        <div class="flex flex-wrap items-center justify-center gap-1 sm:gap-0.5 max-w-[18rem] mx-auto">
            <span class="sr-only">dropdown-open</span>

            <template x-for="(color, index) in colors" :key="index">
                <button class="
                        w-6 h-6 rounded shadow-lg border hover:scale-125 transition-all ease-in-out duration-100 cursor-pointer
                        hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-600 sdark:focus:ring-gray-400
                        dark:border-0 dark:hover:ring-2 dark:hover:ring-gray-400
                    "
                    :style="{ 'background-color': color.value }"
                    x-on:click="select(color)"
                    :title="color.name"
                    type="button">
                </button>
            </template>
        </div>
    </x-wireui::parts.popover>
</div>
