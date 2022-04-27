<div {{ $attributes->only(['class', 'wire:key'])->class('relative') }}
    x-data="wireui_select({
        searchable:  @boolean($searchable),
        multiselect: @boolean($multiselect),
        readonly:    @boolean($readonly || $disabled),
        disabled:    @boolean($disabled),
        placeholder: @js($placeholder),
    })">
    <div hidden x-ref="json">{{ $optionsToJson() }}</div>

    <div class="relative">
        @if ($label)
            <x-dynamic-component
                :component="WireUiComponent::resolve('label')"
                class="mb-1"
                :label="$label"
                :has-error="$name && $errors->has($name)"
                x-on:click="togglePopover"
                wire:key="select.label"
            />
        @endif

        <x-dynamic-component
            :component="WireUiComponent::resolve('input')"
            class="cursor-pointer overflow-hidden dark:text-secondary-400"
            x-ref="input"
            x-on:click="togglePopover"
            x-on:keydown.enter.stop.prevent="togglePopover"
            x-on:keydown.space.stop.prevent="togglePopover"
            x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
            x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
            x-bind:placeholder="getPlaceholder"
            x-bind:value="getValueText"
            readonly
            :name="$name"
            :icon="$icon"
            {{ $attributes->except(['class'])->whereDoesntStartWith(['wire:model', 'type', 'wire:key']) }}
        >
            <x-slot name="prepend">
                <template x-if="config.multiselect">
                    <div class="absolute left-0 inset-y-0 pl-2 pr-14 w-full flex items-center overflow-hidden cursor-pointer"
                        :class="{ 'pointer-events-none': config.readonly }"
                        x-on:click="togglePopover">
                        <div class="flex items-center gap-2 overflow-x-auto hide-scrollbar">
                            <span
                                class="inline-flex text-secondary-700 dark:text-secondary-400 text-sm"
                                x-show="selectedOptions.length"
                                x-text="selectedOptions.length">
                            </span>

                            <template x-for="(option, index) in selected" :key="`selected.${index}`">
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
                                            :component="WireUiComponent::resolve('icon')"
                                            class="h-3 w-3"
                                            name="x"
                                        />
                                    </button>
                                </span>
                            </template>
                        </div>
                    </div>
                </template>
            </x-slot>

            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 gap-x-2">
                    @if ($clearable && !$readonly && !$disabled)
                        <button
                            x-show="!isEmpty()"
                            x-on:click="clear"
                            tabindex="-1"
                            type="button">
                            <x-dynamic-component
                                :component="WireUiComponent::resolve('icon')"
                                class="w-4 h-4 text-secondary-400 hover:text-negative-400"
                                name="x"
                            />
                        </button>
                    @endif

                    <button tabindex="-1" x-on:click="togglePopover" type="button">
                        <x-dynamic-component
                            :component="WireUiComponent::resolve('icon')"
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
    </div>

    <div class="
            absolute w-full mt-1 rounded-lg overflow-hidden shadow-md bg-white z-10 border border-secondary-200
            dark:bg-secondary-800 dark:border-secondary-600
        "
        x-show="popover"
        x-transition
        x-cloak
        x-on:click.outside="closePopover"
        x-on:keydown.escape.window="closePopover">
        @if ($searchable && $options->count() > 10)
            <div class="px-2 my-2" wire:key="search.options">
                <x-dynamic-component
                    :component="WireUiComponent::resolve('input')"
                    class="bg-slate-100"
                    x-ref="search"
                    x-model="search"
                    x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
                    x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
                    shadowless
                    right-icon="search"
                    :placeholder="trans('wireui::messages.searchHere')"
                />
            </div>
        @endif

        <template x-if="popover">
            <ul class="max-h-60 overflow-y-auto select-none"
                tabindex="-1"
                x-ref="optionsContainer"
                x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
                x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
                x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
                x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()">
                <template x-for="(option, index) in displayOptions" :key="`${index}.${option.value}`">
                    <li class="
                            py-2 px-3 focus:outline-none all-colors ease-in-out duration-150 relative group
                            text-secondary-600 dark:text-secondary-400
                        "
                        :class="{
                            'cursor-pointer focus:bg-primary-100 focus:text-primary-800 hover:text-white dark:focus:bg-secondary-700': !option.readonly,
                            'opacity-60 cursor-not-allowed': option.disabled,
                            'font-semibold': isSelected(option),
                            'hover:bg-negative-500 dark:hover:text-secondary-100': !option.readonly && isSelected(option),
                            'hover:bg-primary-500 dark:hover:bg-secondary-700': !option.readonly && !isSelected(option),
                        }"
                        :tabindex="!option.readonly && 0"
                        onclick="this.blur()"
                        x-on:click="!option.readonly && select(option)"
                        x-on:keydown.enter="!option.readonly && select(option)">
                        <span x-text="option.label"></span>

                        <div class="absolute inset-y-0 right-0 flex items-center pr-4" x-show="isSelected(option)">
                            <x-dynamic-component
                                :component="WireUiComponent::resolve('icon')"
                                name="check"
                                class="w-5 h-5 text-primary-600 dark:text-secondary-500 group-hover:text-white"
                            />
                        </div>
                    </li>
                </template>
            </ul>
        </template>
    </div>
</div>
