<x-inputs.wrapper
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'class'])"
    x-data="wireui_color_picker"
    :x-props="WireUi::toJs([
        'colorNameAsValue' => $colorNameAsValue,
        'colors'           => $getColors(),
        'wireModel'        => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
    ])"
>
    @include('wireui::form.wrapper.slots', [
        'except' => ['prefix', 'append']
    ])

    <x-slot:prefix x-show="selected.value">
        <div
            class="w-4 h-4 rounded shadow border"
            :style="{ 'background-color': selected.value }"
        ></div>
    </x-slot:prefix>

    <x-wireui::inputs.element
        x-model="selected.value"
        x-on:input="setColor($event.target.value)"
        x-on:blur="onBlur($event.target.value)"
        x-ref="input"
        :attributes="$attrs
            ->whereDoesntStartWith('wire:model')
            ->except(['wire:key', 'x-data', 'class'])
        "
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
            root-class="sm:w-full justify-end"
            class="
                max-h-64 py-2 px-1 sm:w-auto sm:max-w-[19rem] sm:max-h-60 overflow-y-auto
                overscroll-contain soft-scrollbar select-none
            "
            x-ref="optionsContainer"
            tabindex="-1"
            name="wireui.select.options.{{ $name }}"
            x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
            x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
            x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
            x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
        >
             <div class="flex flex-wrap items-center justify-center gap-1 sm:gap-0.5 mx-auto">
                 <template x-for="color in colors" :key="`${color.value}.${color.name}`">
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
