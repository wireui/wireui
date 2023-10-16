<x-wrapper
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class'])"
    x-data="wireui_select"
    :x-props="WireUi::phpToJs([
        'asyncData'         => $asyncData,
        'optionValue'       => $optionValue,
        'optionLabel'       => $optionLabel,
        'optionDescription' => $optionDescription,
        'hasSlot'           => $slot->isNotEmpty(),
        'multiselect'       => $multiselect,
        'searchable'        => $searchable,
        'clearable'         => $clearable,
        'readonly'          => $readonly || $disabled,
        'placeholder'       => $placeholder,
        'template'          => $template,
        'wireModel'         => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
    ])"
>
    <div hidden x-ref="json">@toJs($optionsToArray())</div>
    <div hidden x-ref="slot">{{ $slot }}</div>

    @if (app()->runningUnitTests())
        <div dusk="select.{{ $name }}">
            {!! json_encode($optionsToArray()) !!}
        </div>
    @endif

    @include('wireui::components.wrapper.slots', [
        'except' => ['append', 'prepend']
    ])

    <x-slot:prepend x-bind:class="{
        'pointer-events-none': config.readonly,
        'cursor-pointer': !config.readonly,
    }">
        <template x-if="!config.multiselect">
            <div
                @class([
                    'absolute left-0 inset-y-0 w-[calc(100%-3.5rem)] flex items-center',
                    'pl-3.5' => !$icon,
                    'pl-2.5' =>  $icon,
                ])
                x-on:click="toggle"
            >
                @if ($icon != null)
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        :name="$icon"
                        class="w-5 h-5 mr-1 text-gray-400 dark:text-gray-600"
                    />
                @endif

                <span
                    class="text-sm truncate text-secondary-700 dark:text-secondary-400"
                    x-show="!isEmpty()"
                    x-html="getSelectedDisplayText()"
                ></span>
            </div>
        </template>

        <template x-if="config.multiselect">
            <div
                class="absolute left-0 pl-2.5 inset-y-0 w-full h-full flex items-center overflow-hidden"
                x-on:click="toggle"
            >
                <div class="flex items-center gap-2 overflow-x-auto hide-scrollbar">
                    @if ($icon)
                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            :name="$icon"
                            class="w-5 h-5 text-gray-400 dark:text-gray-600"
                        />
                    @endif

                    @if (!$withoutItemsCount)
                        <span
                            class="inline-flex text-sm text-secondary-700 dark:text-secondary-400"
                            x-show="selectedOptions.length"
                            x-text="selectedOptions.length"
                        ></span>
                    @endif

                    <div wire:ignore class="flex items-center gap-1 flex-nowrap">
                        <template x-for="(option, index) in selectedOptions" :key="`selected.${index}`">
                            <span class="
                                inline-flex items-center py-0.5 pl-2 pr-0.5 rounded-full text-xs font-medium
                                border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700
                                dark:bg-secondary-700 dark:text-secondary-400 dark:border-none
                            ">
                                <span style="max-width: 5rem" class="truncate" x-text="option.label"></span>

                                <button
                                    class="flex items-center justify-center w-4 h-4 shrink-0 text-secondary-400 hover:text-secondary-500"
                                    x-on:click.stop="unSelect(option)"
                                    tabindex="-1"
                                    type="button"
                                >
                                    <x-dynamic-component
                                        :component="WireUi::component('icon')"
                                        class="w-3 h-3"
                                        name="x-mark"
                                    />
                                </button>
                            </span>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </x-slot:prepend>

    <x-wireui::wrapper.element
        x-ref="input"
        x-on:click="toggle"
        x-on:focus="open"
        x-on:blur.debounce.750ms="closeIfNotFocused"
        x-on:keydown.enter.stop.prevent="toggle"
        x-on:keydown.space.stop.prevent="toggle"
        x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
        x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
        x-bind:placeholder="getPlaceholder"
        x-bind:value="getSelectedValue"
        inputmode="none"
        readonly
        autocomplete="disabled"
        :attributes="$attrs
            ->except('class')
            ->class('cursor-pointer overflow-hidden !text-transparent !dark:text-transparent selection:bg-transparent')
            ->whereDoesntStartWith(['wire:model', 'type', 'wire:key'])
            ->except(['wire:key', 'x-data'])
        "
    />

    <x-slot name="append">
        <div class="flex items-center pr-2 gap-x-2">
            @if ($clearable && !$readonly && !$disabled)
                <button
                    x-show="!isEmpty()"
                    x-on:click="clear"
                    tabindex="-1"
                    type="button"
                    x-cloak
                >
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        class="w-4 h-4 text-secondary-400 hover:text-negative-400"
                        name="x-mark"
                    />
                </button>
            @endif

            <button tabindex="-1" x-on:click="toggle" type="button">
                <x-dynamic-component
                    :component="WireUi::component('icon')"
                    @class([
                        'w-5 h-5',
                        'text-negative-400 dark:text-negative-600' =>  $invalidated,
                        'text-secondary-400'                       => !$invalidated,
                    ])
                    :name="$rightIcon"
                />
            </button>
        </div>
    </x-slot>

    <x-slot:after>
        <x-wireui::parts.popover :margin="(bool) $label" root-class="sm:w-full">
            <template x-if="asyncData.api || (config.searchable && options.length >= @js($minItemsForSearch))">
                <div class="px-2 my-2" wire:key="search.options.{{ $name }}">
                    <x-dynamic-component
                        :component="WireUi::component('input')"
                        class="bg-slate-100"
                        x-ref="search"
                        x-model.debounce.{{ $asyncData ? 750 : 0 }}ms="search"
                        x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
                        x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
                        shadowless
                        right-icon="magnifying-glass"
                        :placeholder="trans('wireui::messages.search_here')"
                    />
                </div>
            </template>

            <div
                class="overflow-y-auto select-none max-h-64 sm:max-h-60 overscroll-contain soft-scrollbar"
                tabindex="-1"
                x-ref="optionsContainer"
                name="wireui.select.options.{{ $name }}"
                x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
                x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
                x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
                x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
            >
                <div
                    class="w-full h-0.5 rounded-full relative overflow-hidden"
                    :class="{ 'bg-gray-200 dark:bg-gray-700': asyncData.fetching }"
                >
                    <div
                        class="bg-primary-500 h-0.5 rounded-full absolute animate-linear-progress"
                        style="width: 30%"
                        x-show="asyncData.fetching"
                    ></div>
                </div>

                @isset ($beforeOptions)
                    <div {{ $beforeOptions->attributes }}>
                        {{ $beforeOptions }}
                    </div>
                @endisset

                <ul x-ref="listing" wire:ignore>
                    <template x-for="(option, index) in displayOptions" :key="`${index}.${option.value}`">
                        <li tabindex="-1" :index="index">
                            <div class="px-2 py-0.5">
                                <div class="w-full h-8 rounded animate-pulse bg-slate-200 dark:bg-slate-600"></div>
                            </div>
                        </li>
                    </template>
                </ul>

                @unless ($hideEmptyMessage)
                    <div
                        class="px-3 py-12 text-center cursor-pointer sm:py-2 sm:px-3 sm:text-left text-secondary-500"
                        x-show="displayOptions.length === 0"
                        x-on:click="close"
                    >
                        {{ $emptyMessage ?? trans('wireui::messages.empty_options') }}
                    </div>
                @endunless

                @isset ($afterOptions)
                    <div {{ $afterOptions->attributes }}>
                        {{ $afterOptions }}
                    </div>
                @endisset
            </div>
        </x-wireui::parts.popover>
    </x-slot:after>
</x-wrapper>
