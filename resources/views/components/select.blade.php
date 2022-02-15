<div x-data="wireui_select({
        model:       @entangle($attributes->wire('model')),
        searchable:  @boolean($searchable),
        multiselect: @boolean($multiselect),
        readonly:    @boolean($readonly),
        disabled:    @boolean($disabled),
        placeholder: '{{ $placeholder }}',
        optionValue: '{{ $optionValue }}',
        optionLabel: '{{ $optionLabel }}',
    })" class="relative" {{ $attributes->only('wire:key') }}>
    <div class="relative">
        <x-dynamic-component
            :component="WireUiComponent::resolve('label')"
            class="mb-1"
            :label="$label"
            :has-error="$errors->has($name) ?? false"
            x-on:click="togglePopover"
        />

        <x-dynamic-component
            :component="WireUiComponent::resolve('input')"
            class="cursor-pointer overflow-hidden dark:text-secondary-400"
            x-ref="select"
            x-on:click="togglePopover"
            x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
            x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
            x-bind:placeholder="getPlaceholderText()"
            x-bind:value="getValueText()"
            readonly
            :name="$name"
            :icon="$icon"
            {{ $attributes->whereDoesntStartWith(['wire:model', 'type', 'wire:key']) }}>

            <x-slot name="prepend">
                <div class="absolute left-0 inset-y-0 pl-2 pr-14 w-full flex items-center overflow-hidden cursor-pointer"
                     :class="{ 'pointer-events-none': disabled || readonly }"
                     x-show="multiselect"
                     x-on:click="togglePopover">
                    <div class="flex items-center gap-2 overflow-x-auto hide-scrollbar">
                        <span class="inline-flex text-secondary-700 dark:text-secondary-400 text-sm"
                              x-show="selectedOptions.length"
                              x-text="model ? model.length : ''">
                        </span>
                        <template x-for="selected in selectedOptions" :key="`selected.${selected.value}`">
                            <span class="
                                    inline-flex items-center py-0.5 pl-2 pr-0.5 rounded-full text-xs font-medium
                                    border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700
                                    dark:bg-secondary-700 dark:text-secondary-400 dark:border-none
                                ">
                                <span style="max-width: 5rem" class="truncate" x-text="selected.label"></span>

                                <button class="
                                        shrink-0 h-4 w-4 flex items-center text-secondary-400
                                        justify-center hover:text-secondary-500 focus:outline-none
                                    "
                                    x-on:click.stop="unSelect(selected.value)"
                                    type="button">
                                    <x-dynamic-component
                                        :component="WireUiComponent::resolve('icon')"
                                        class="h-3 w-3"
                                        name="x"
                                    />
                                </button>
                            </span>
                        </template>
                    </div>
                </div>
            </x-slot>

            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 gap-x-2">
                    @if ($clearable)
                        <button
                            class="focus:outline-none"
                            x-show="!isEmptyModel() && !disabled && !readonly"
                            x-on:click="clearModel"
                            type="button">
                            <x-dynamic-component
                                :component="WireUiComponent::resolve('icon')"
                                class="w-4 h-4 text-secondary-400 hover:text-negative-400"
                                name="x"
                            />
                        </button>
                    @endif

                    <button class="focus:outline-none" x-on:click="togglePopover" type="button">
                        <x-dynamic-component
                            :component="WireUiComponent::resolve('icon')"
                            class="w-5 h-5
                            {{ $errors->has($name)
                                ? 'text-negative-400 dark:text-negative-600'
                                : 'text-secondary-400'
                            }}"
                            :name="$rightIcon"
                        />
                    </button>
                </div>
            </x-slot>
        </x-dynamic-component>
    </div>

    <div class="
            absolute w-full mt-1 rounded-lg overflow-hidden shadow-md bg-white z-10 border border-secondary-200
            dark:bg-secondary-800 dark:border-secondary-600
        "
        x-show="popover"
        x-cloak
        x-on:click.outside="closePopover"
        x-on:keydown.escape.window="closePopover">
        @if ($options ? count($options) >= 10 : $searchable)
            <div class="px-2 my-2">
                <x-dynamic-component
                    :component="WireUiComponent::resolve('input')"
                    class="
                        focus:shadow-md bg-slate-100 focus:ring-primary-600 focus:border-primary-600
                        border border-secondary-200 dark:border-secondary-600 duration-300
                    "
                    x-ref="search"
                    x-model="search"
                    x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
                    x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
                    borderless
                    shadowless
                    right-icon="search"
                    :placeholder="trans('wireui::messages.searchHere')"
                    wire:key="select-search"
                />
            </div>
        @endif

        <ul class="max-h-60 overflow-y-auto select-none"
            tabindex="-1"
            x-ref="optionsContainer"
            x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
            x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
            x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
            x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()">
            @if ($options)
                @forelse ($options as $key => $option)
                    <x-dynamic-component
                        :component="data_get($option, 'component', $optionComponent)"
                        :label="$getOptionLabel($key, $option)"
                        :value="$getOptionValue($key, $option)"
                        :disabled="data_get($option, 'disabled', false)"
                        :readonly="data_get($option, 'readonly', false)"
                        :option="$option"
                    />
                @empty
                    <x-dynamic-component
                        :component="WireUiComponent::resolve('select.option')"
                        class="text-secondary-500"
                        x-on:click="closePopover"
                        :label="trans('wireui::messages.empty_options')"
                        readonly
                    />
                @endforelse
            @else {{ $slot }} @endif
        </ul>
    </div>
</div>
