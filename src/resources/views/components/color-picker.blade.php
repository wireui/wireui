<x-inputs.wrapper
    :x-data="WireUi::alpine('wireui_color_picker', [
        'colorNameAsValue' => $colorNameAsValue,
        'colors'           => $getColors(),
        'wireModel'        => WireUi::wireModel($this, $attributes),
        'value'            => $value
    ])"
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'class'])"
>
    @include('wireui::form.wrapper.slots')

    <x-slot:prefix>
        <template x-if="selected.value">
            <div
                class="w-4 h-4 rounded shadow border"
                :style="{ 'background-color': selected.value }"
            ></div>
        </template>
    </x-slot:prefix>

    <x-wireui::inputs.element
        x-model="value"
        x-on:input="setColor($event.target.value)"
        x-ref="input"
        :attributes="$attrs->except(['wire:key', 'x-data', 'class'])"
    />

    <x-slot:append>
        <x-dynamic-component
            :component="WireUi::component('button')"
            class="h-full rounded-r-md"
            primary
            flat
            squared
            x-on:click="toggle"
            trigger
            :disabled="$disabled"
        >
            <x-dynamic-component
                :component="WireUi::component('icon')"
                class="
                    w-4 h-4 group-focus:text-primary-700 text-gray-400 dark:text-gray-600
                    dark:group-hover:text-gray-500 dark:group-focus:text-primary-500
                "
                :name="$rightIcon"
            />
        </x-dynamic-component>
    </x-slot:append>

    <x-slot:after>
        <x-wireui::parts.popover
            :margin="(bool) $label"
            class="
                max-h-56 py-3 px-2 sm:py-2 sm:rounded-xl
                overflow-y-auto soft-scrollbar border border-secondary-200
            "
        >
            <div class="flex flex-wrap items-center justify-center gap-1 sm:gap-0.5 max-w-[18rem] mx-auto">
                <template x-for="(color, index) in colors" :key="index">
                    <button
                        class="
                            w-6 h-6 rounded shadow-lg border hover:scale-125 transition-all ease-in-out duration-100 cursor-pointer
                            hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-600 dark:focus:ring-gray-400
                            dark:border-0 dark:hover:ring-2 dark:hover:ring-gray-400
                        "
                        :style="{ 'background-color': color.value }"
                        x-on:click="select(color)"
                        :title="color.name"
                        type="button"
                    ></button>
                </template>
            </div>
        </x-wireui::parts.popover>
    </x-slot:after>
</x-inputs.wrapper>
