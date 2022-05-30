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
                    class="w-4 h-4 rounded shadow-lg border"
                    :style="{ 'background-color': selected }"
                ></div>
            </template>
        </x-slot>

        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                <x-dropdown width="w-[14.6rem]" height="max-h-40" x-modelable="status" x-model="state" persistent>
                    <x-slot name="trigger">
                        <x-button
                            class="h-full rounded-r-md"
                            primary
                            flat
                            squared
                            dusk="dropdown.toggle"
                        >
                            <x-icon
                                class="
                                    w-4 h-4 group-focus:text-primary-700 text-gray-400 dark:text-gray-600
                                    dark:group-hover:text-gray-500 dark:group-focus:text-primary-500
                                "
                                :name="$rightIcon"
                            />
                        </x-button>
                    </x-slot>

                    <div class="flex flex-wrap items-center gap-0.5">
                        <span class="sr-only">dropdown-open</span>

                        <template x-for="(color, index) in colors" :key="index">
                            <button class="
                                    w-5 h-5 rounded shadow-lg border hover:scale-125 transition-all ease-in-out duration-100 cursor-pointer
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
                </x-dropdown>
            </div>
        </x-slot>
    </x-input>
</div>
