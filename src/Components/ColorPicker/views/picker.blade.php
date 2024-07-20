<x-dynamic-component
    :component="WireUi::component('text-field')"
    x-ref="container"
    :config="$config"
    :attributes="$wrapper"
    x-data="wireui_color_picker"
    :x-props="WireUi::toJs([
        'colorNameAsValue' => $colorNameAsValue,
        'colors'           => $getColors(),
        'wireModel'        => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
        'alpineModel'      => WireUi::alpineModel($attributes),
    ])"
>
    @include('wireui-wrapper::components.slots', [
        'except' => ['prefix', 'append']
    ])

    <x-slot:prefix x-show="selected?.value">
        <div
            class="w-4 h-4 border rounded shadow"
            :style="{ 'background-color': selected?.value }"
        ></div>
    </x-slot:prefix>

    <x-wireui-wrapper::element
        x-ref="input"
        :attributes="$input"
        x-model.fill="selected.value"
        x-on:blur="onBlur($event.target.value)"
        x-on:input="setColor($event.target.value)"
    />

    <x-slot:append>
        <x-dynamic-component
            :component="WireUi::component('button')"
            class="h-full"
            :color="$color ?? 'primary'"
            :rounded="data_get($roundedClasses, 'append', '')"
            use-validation-colors
            flat
            x-on:click="positionable.toggle()"
            :disabled="$disabled"
            x-on:keydown.arrow-down.prevent="focusable.walk.to('down')"
        >
            <x-dynamic-component
                :component="WireUi::component('icon')"
                :name="$rightIcon"
                @class([
                    'w-4 h-4 group-focus:text-primary-700 text-gray-400 dark:text-gray-600',
                    'dark:group-hover:text-gray-500 dark:group-focus:text-primary-500',
                ])
            />
        </x-dynamic-component>
    </x-slot:append>

    <x-slot:after>
        <x-dynamic-component
            :component="WireUi::component('popover')"
            :margin="(bool) $label"
            root-class="justify-end sm:w-full"
            @class([
                'max-h-64 select-none overflow-hidden',
                'sm:w-auto sm:max-w-[19rem]',
            ])
            x-ref="optionsContainer"
            tabindex="-1"
            x-on:keydown.tab.prevent="$event.shiftKey || focusable.next()?.focus()"
            x-on:keydown.shift.tab.prevent="focusable.previous()?.focus()"
            x-on:keydown.arrow-up.prevent="focusable.walk.to('up')"
            x-on:keydown.arrow-down.prevent="focusable.walk.to('down')"
            x-on:keydown.arrow-left.prevent="focusable.walk.to('left')"
            x-on:keydown.arrow-right.prevent="focusable.walk.to('right')"
        >
             <div
                 @class([
                    'max-h-60 overflow-y-auto overscroll-contain soft-scrollbar py-2 px-1',
                    'flex flex-wrap items-center justify-center gap-1 sm:gap-0.5 mx-auto',
                 ])
                 x-ref="colorsContainer"
             >
                 <template x-for="(color, index) in colors" :key="index + color.value + color.name">
                     <button
                        @class([
                            'w-6 h-6 rounded shadow-lg border hover:scale-125 transition-all ease-in-out duration-100 cursor-pointer',
                            'hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-600 dark:focus:ring-gray-400',
                            'dark:border-0 dark:hover:ring-2 dark:hover:ring-gray-400',
                        ])
                         :style="{ 'background-color': color.value }"
                         x-on:click="select(color)"
                         :title="color.name"
                         type="button"
                     ></button>
                 </template>
             </div>
        </x-dynamic-component>
    </x-slot:after>
</x-dynamic-component>
