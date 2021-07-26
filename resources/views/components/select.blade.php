<div x-data="{
    searchable:  @boolean($searchable),
    multiselect: @boolean($multiselect),
    readonly:    @boolean($readonly),
    disabled:    @boolean($disabled),
    popover: false,
    search: '',
    placeholder: '{{ $placeholder }}',
    optionValue: '{{ $optionValue }}',
    optionLabel: '{{ $optionLabel }}',
    model: @entangle($attributes->wire('model')),
    selectedOptions: [],

    togglePopover() {
        if (this.readonly || this.disabled) return

        this.popover = !this.popover
        this.$refs.select.dispatchEvent(new Event(this.popover ? 'open' : 'close'))
    },
    closePopover() {
        this.popover = false
        this.$refs.select.dispatchEvent(new Event('close'))
    },
    isSelected(value) {
        if (this.multiselect) {
            return !!Object.values(this.model ?? []).find(option => option == value)
        }

        return value == this.model
    },
    unSelect(value) {
        if (this.disabled || this.readonly) return

        let index = this.selectedOptions.findIndex(option => option.value == value)
        this.selectedOptions.splice(index, 1)

        index = this.model.findIndex(selected => selected == value)
        this.model.splice(index, 1)

        this.$refs.select.dispatchEvent(new Event('select'))
    },
    select(value) {
        if (this.disabled || this.readonly) return

        this.search = ''

        if (this.multiselect) {
            this.model  = Object.assign([], this.model)
            const index = this.model.findIndex(selected => selected == value)

            if (~index) return this.unSelect(value)

            const { dataset: option } = this.getOptionElement(value)
            this.$refs.select.dispatchEvent(new Event('select'))
            this.selectedOptions.push(option)

            return this.model.push(value)
        }

        if (value === this.model) { value = null }

        this.model = value
        this.$refs.select.dispatchEvent(new Event('select'))
        this.closePopover()
    },
    clearModel() {
        const value = this.multiselect ? [] : null
        this.model  = value
        this.selectedOptions = []
        this.$refs.select.dispatchEvent(new Event('clear'))
    },
    isEmptyModel() {
        if (this.multiselect) {
            return this.model?.length == 0
        }

        return this.model == null
    },
    getOptionElement(value) {
        return this.$refs.optionsContainer.querySelector(`[data-value='${value}']`)
    },
    getPlaceholderText() {
        if (this.model?.toString().length) return null

        return this.placeholder
    },
    getValueText() {
        if (this.multiselect || !this.model?.toString().length) return null

        return this.decodeSpecialChars(this.getOptionElement(this.model).dataset.label)
    },
    isAvailableInList(search, option) {
        const label = this.decodeSpecialChars(option.dataset.label)
        const value = this.decodeSpecialChars(option.dataset.value)

        return label.toLowerCase().includes(search)
            || value.toLowerCase().includes(search)
    },
    filterOptions(search) {
        const options = [...this.$refs.optionsContainer.children]
        options.map(option => {
            if (this.isAvailableInList(search.toLowerCase(), option)) {
                option.classList.remove('hidden')
            } else {
                option.classList.add('hidden')
            }
        })
    },
    initMultiSelect() {
        if (!this.multiselect) return

        if (typeof this.model === 'string') {
            this.model = []
        }

        this.model?.map(selected => {
            const { dataset: option } = this.getOptionElement(selected)
            this.selectedOptions.push(option)
        })
    },
    modelWasChanged() {
        return this.model?.toString()
            !== this.selectedOptions.map(option => option.value).toString()
    },
    syncSelected(newModel) {
        if (!this.multiselect || !this.modelWasChanged()) return

        this.selectedOptions = this.model?.map(option => {
            return this.getOptionElement(option).dataset
        }) ?? []
    },
    decodeSpecialChars(text) {
        const textarea     = document.createElement('textarea')
        textarea.innerHTML = text

        return textarea.value
    },
    getFocusables() { return [...this.$el.querySelectorAll('li, input')] },
    getFirstFocusable() { return this.getFocusables().shift() },
    getLastFocusable() { return this.getFocusables().pop() },
    getNextFocusable() { return this.getFocusables()[this.getNextFocusableIndex()] || this.getFirstFocusable() },
    getPrevFocusable() { return this.getFocusables()[this.getPrevFocusableIndex()] || this.getLastFocusable() },
    getNextFocusableIndex() { return (this.getFocusables().indexOf(document.activeElement) + 1) % (this.getFocusables().length + 1) },
    getPrevFocusableIndex() { return Math.max(0, this.getFocusables().indexOf(document.activeElement)) -1 },
}"
class="relative"
x-init="function() {
    this.initMultiSelect()

    $watch('popover', status => {
        if (status) {
            this.$nextTick(() => this.$refs.search?.focus())
        }
    })
    $watch('model', selected => this.syncSelected(selected))
    $watch('search', search => this.filterOptions(search?.toLowerCase()))
}">
    <div class="relative">
        <x-label
            class="mb-1"
            :label="$label"
            :has-error="$errors->has($name) ?? false"
            x-on:click="togglePopover"
        />
        <x-input
            class="cursor-pointer overflow-hidden dark:text-secondary-400"
            x-ref="select"
            x-on:click="togglePopover"
            x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
            x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
            readonly
            :name="$name"
            :icon="$icon"
            ::placeholder="getPlaceholderText()"
            ::value="getValueText()"
            {{ $attributes->whereDoesntStartWith(['wire:model', 'type']) }}
        >
            <x-slot name="prepend">
                <div class="absolute left-0 inset-y-0 pl-2 pr-14 w-full flex items-center overflow-hidden cursor-pointer"
                    :class="{ 'pointer-events-none': disabled || readonly }"
                    x-show="multiselect"
                    x-on:click="togglePopover">
                    <div class="flex items-center gap-2 overflow-x-auto hide-scrollbar">
                        <span class="inline-flex text-secondary-700 dark:text-secondary-400 text-sm"
                            x-show="selectedOptions.length"
                            x-text="model?.length">
                        </span>
                        <template x-for="selected in selectedOptions" :key="`selected.${selected.value}`">
                            <span class="inline-flex items-center py-0.5 pl-2 pr-0.5 rounded-full text-xs font-medium
                                         border border-secondary-200 shadow-sm bg-secondary-100 text-secondary-700
                                         dark:bg-secondary-700 dark:text-secondary-400 dark:border-none
                                ">
                                <span style="max-width: 5rem" class="truncate" x-text="selected.label"></span>
                                <button class="flex-shrink-0 h-4 w-4 flex items-center text-secondary-400
                                               justify-center hover:text-secondary-500 focus:outline-none"
                                    x-on:click.stop="unSelect(selected.value)"
                                    type="button">
                                    <x-icon name="x" class="h-3 w-3" />
                                </button>
                            </span>
                        </template>
                    </div>
                </div>
            </x-slot>

            <x-slot name="append">
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 gap-x-2">
                    <button class="focus:outline-none"
                        x-show="!isEmptyModel() && !disabled && !readonly"
                        x-on:click="clearModel"
                        type="button">
                        <x-icon name="x" class="w-4 h-4 text-secondary-400 hover:text-negative-400" />
                    </button>
                    <button class="focus:outline-none" x-on:click="togglePopover" type="button">
                        <x-icon
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
        </x-input>
    </div>

    <div class="absolute w-full mt-1 rounded-lg overflow-hidden shadow-md bg-white z-10 border border-secondary-200
                dark:bg-secondary-800 dark:border-secondary-600"
        x-show="popover"
        x-cloak
        x-on:click.outside="closePopover"
        x-on:keydown.escape.window="closePopover">
        @if ($options ? count($options) >= 10 : $searchable)
            <div class="px-2 my-2">
                <x-input class="focus:shadow-md bg-blueGray-100 focus:ring-primary-600 focus:border-primary-600
                                border border-secondary-200 dark:border-secondary-600 duration-300"
                    x-ref="search"
                    x-model="search"
                    x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
                    x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
                    borderless
                    shadowless
                    right-icon="search"
                    placeholder="Search here"
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
                    <x-select.option
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
