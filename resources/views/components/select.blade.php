<div {{ $attributes->only(['class', 'wire:key'])->class('relative') }}
    x-data="wireui_select({
        @if ($attributes->wire('model')->value())
            wireModel: @entangleable($attributes->wire('model')),
        @endif
    })"
    x-props="{
        asyncData:    @toJs($asyncData),
        optionValue:  @toJs($optionValue),
        optionLabel:  @toJs($optionLabel),
        optionDescription: @toJs($optionDescription),
        hasSlot:     @boolean($slot->isNotEmpty()),
        multiselect: @boolean($multiselect),
        searchable:  @boolean($searchable),
        clearable:   @boolean($clearable),
        readonly:    @boolean($readonly || $disabled),
        placeholder: @toJs($placeholder),
        template:    @toJs($template),
    }">
    <div hidden x-ref="json">@toJs($optionsToArray())</div>
    <div hidden x-ref="slot">{{ $slot }}</div>

    @if (app()->runningUnitTests())
        <div dusk="select.{{ $name }}">
            {!! json_encode($optionsToArray()) !!}
        </div>
    @endif

    <div class="relative">
        @if ($label)
            <x-dynamic-component
                :component="WireUi::component('label')"
                class="mb-1"
                :label="$label"
                :has-error="$name && $errors->has($name)"
                :disabled="$disabled"
                x-on:click="toggle"
                :wire:key="'select.label.' . $name"
            />
        @endif

        <x-dynamic-component
            :component="WireUi::component('input')"
            class="cursor-pointer overflow-hidden !text-transparent !dark:text-transparent selection:bg-transparent"
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
            :name="$name"
            {{ $attributes
                ->except(['class'])
                ->class(['pl-8' => $icon])
                ->whereDoesntStartWith(['wire:model', 'type', 'wire:key'])
            }}>
            <x-slot name="prepend">
                <div :class="{
                    'pointer-events-none': config.readonly,
                    'cursor-pointer': !config.readonly,
                }">
                    <template x-if="!config.multiselect">
                        <div @class([
                                'absolute left-0 inset-y-0 w-[calc(100%-3.5rem)] flex items-center',
                                'pl-2.5' =>  $icon,
                                'pl-3.5' => !$icon,
                            ])
                            x-on:click="toggle">
                            @if ($icon)
                                <x-dynamic-component
                                    :component="WireUi::component('icon')"
                                    :name="$icon"
                                    class="h-5 w-5 mr-1 text-gray-400 dark:text-gray-600"
                                />
                            @endif

                            <span
                                class="truncate text-secondary-700 dark:text-secondary-400 text-sm"
                                x-show="!isEmpty()"
                                x-html="getSelectedDisplayText()">
                            </span>
                        </div>
                    </template>

                    <template x-if="config.multiselect">
                        <div class="absolute left-0 inset-y-0 pl-3 pr-14 w-full flex items-center overflow-hidden" x-on:click="toggle">
                            <div class="flex items-center gap-2 overflow-x-auto hide-scrollbar">
                                @if ($icon)
                                    <x-dynamic-component
                                        :component="WireUi::component('icon')"
                                        :name="$icon"
                                        class="h-5 w-5 text-gray-400 dark:text-gray-600"
                                    />
                                @endif

                                @if (!$withoutItemsCount)
                                    <span
                                        class="inline-flex text-secondary-700 dark:text-secondary-400 text-sm"
                                        x-show="selectedOptions.length"
                                        x-text="selectedOptions.length">
                                    </span>
                                @endif

                                <div wire:ignore class="flex flex-nowrap items-center gap-1">
                                    <template x-for="(option, index) in selectedOptions" :key="`selected.${index}`">
                                        <span class="
                                                inline-flex items-center py-0.5 pl-2 pr-0.5 rounded-full text-xs font-medium
                                                border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700
                                                dark:bg-secondary-700 dark:text-secondary-400 dark:border-none
                                            ">
                                            <span style="max-width: 5rem" class="truncate" x-text="option.label"></span>

                                            <button
                                                class="shrink-0 h-4 w-4 flex items-center text-secondary-400 justify-center hover:text-secondary-500"
                                                x-on:click.stop="unSelect(option)"
                                                tabindex="-1"
                                                type="button">
                                                <x-dynamic-component
                                                    :component="WireUi::component('icon')"
                                                    class="h-3 w-3"
                                                    name="x"
                                                />
                                            </button>
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </x-slot>

            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 gap-x-2">
                    @if ($clearable && !$readonly && !$disabled)
                        <button
                            x-show="!isEmpty()"
                            x-on:click="clear"
                            tabindex="-1"
                            type="button"
                            x-cloak>
                            <x-dynamic-component
                                :component="WireUi::component('icon')"
                                class="w-4 h-4 text-secondary-400 hover:text-negative-400"
                                name="x"
                            />
                        </button>
                    @endif

                    <button tabindex="-1" x-on:click="toggle" type="button">
                        <x-dynamic-component
                            :component="WireUi::component('icon')"
                            class="w-5 h-5
                            {{ $name && $errors->has($name)
                                ? 'text-negative-400 dark:text-negative-600'
                                : 'text-secondary-400'
                            }}"
                            :name="$rightIcon"
                        />
                    </button>
                </div>
            </x-slot>
        </x-dynamic-component>

        @if ($hint)
            <label @if ($id) for="{{ $id }}" @endif class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
                {{ $hint }}
            </label>
        @endif
    </div>

    <x-wireui::parts.popover :margin="(bool) $label" root-class="sm:w-full">
        <template x-if="asyncData.api || (config.searchable && options.length >= @toJs($minItemsForSearch))">
            <div class="px-2 my-2" wire:key="search.options.{{ $name }}">
                <x-dynamic-component
                    :component="WireUi::component('input')"
                    class="bg-slate-100"
                    x-ref="search"
                    x-model.debounce.{{ $asyncData ? 750 : 0 }}ms="search"
                    x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
                    x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
                    shadowless
                    right-icon="search"
                    :placeholder="trans('wireui::messages.searchHere')"
                />
            </div>
        </template>

        <div class="max-h-64 sm:max-h-60 overflow-y-auto overscroll-contain soft-scrollbar select-none"
            tabindex="-1"
            x-ref="optionsContainer"
            name="wireui.select.options.{{ $name }}"
            x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
            x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
            x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
            x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()">
            <div class="w-full h-0.5 rounded-full relative overflow-hidden"
                :class="{
                    'bg-gray-200 dark:bg-gray-700': asyncData.fetching
                }">
                <div class="bg-primary-500 h-0.5 rounded-full absolute animate-linear-progress"
                    style="width: 30%"
                    x-show="asyncData.fetching">
                </div>
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
                            <div class="h-8 w-full animate-pulse bg-slate-200 dark:bg-slate-600 rounded"></div>
                        </div>
                    </li>
                </template>
            </ul>

            @unless ($hideEmptyMessage)
                <div class="py-12 px-3 sm:py-2 sm:px-3 text-center sm:text-left text-secondary-500 cursor-pointer"
                    x-show="displayOptions.length === 0"
                    x-on:click="close">
                    {{ $emptyMessage ?? __('wireui::messages.empty_options') }}
                </div>
            @endunless

            @isset ($afterOptions)
                <div {{ $afterOptions->attributes }}>
                    {{ $afterOptions }}
                </div>
            @endisset
        </div>
    </x-wireui::parts.popover>
</div>
