<div x-data="{
    model: @entangle($attributes->wire('model')),
    input: null,
    config: {
        isLazy: @boolean($attributes->wire('model')->hasModifier('lazy')),
        interval: {{ $interval }},
        format: '{{ $format }}',
        is12H: @boolean($format === '12'),
        readonly: @boolean($readonly),
        disabled: @boolean($disabled),
    },
    search: '',
    showPicker: false,
    times: [],
    filteredTimes: [],

    maskInput(value) {
        const mask = this.config.is12H ? 'h:m AA' : 'H:m'

        return $wireui.utils.mask(mask, value)
    },
    openPicker() {
        if (this.config.readonly || this.config.disabled) return

        this.fillTimes()
        this.showPicker = true
        this.search = ''
        this.filteredTimes = this.times

        if (window.innerWidth >= 1000) {
            this.$nextTick(() => {
                this.$refs.search.focus()
            })
        }
    },
    closePicker() { this.showPicker = false },
    clearInput() {
        this.input   = null
        let dateTime = null

        if (this.hasDate(this.model)) {
            dateTime = this.model.slice(0, 10)
        }

        this.model = dateTime
    },
    fillTimes() {
        if (this.times.length > 0) return

        const times       = []
        let startTime     = 0
        const timePeriods = ['AM', 'PM']

        for (let i = 0; startTime < 24 * 60; i++) {
            const hour       = Math.floor(startTime / 60)
            let formatedHour = this.config.is12H ? Number(hour % 12) : hour.toString().padStart(2, '0')
            const minutes    = Number(startTime % 60).toString().padStart(2, '0')
            const timePeriod = timePeriods[Math.floor(hour / 12)]

            if (this.config.is12H && formatedHour === '00') { formatedHour = 12 }

            let time = `${formatedHour}:${minutes}`

            if (this.config.is12H) time += ` ${timePeriod}`

            times.push(time)

            startTime += this.config.interval
        }

        this.times = times
    },
    selectTime(time) {
        this.input = time
        this.closePicker()
        this.emitInput()
    },
    onInput(value) {
        if (this.config.is12H) {
            const timePeriod = value?.replace(/[^a-zA-Z]+/g, '')?.toLocaleUpperCase()
            const hasAMPM    = 'AMPM'.includes(timePeriod)

            if (timePeriod && !'AMPM'.includes(timePeriod)) {
                const index = 'AP'.includes(timePeriod[0]) ? 7 : 6

                return this.input = value.slice(0, index)
            }
        }

        this.input = this.maskInput(value)

        if (!this.config.isLazy) {
            this.emitInput()
        }
    },
    onSearch(search) {
        const mask  = this.config.is12H ? 'h:m' : 'H:m'
        this.search = $wireui.utils.mask(mask, search) ?? ''
        this.filteredTimes = this.times.filter(time => time.includes(this.search))

        if (this.filteredTimes.length === 0) {
            if (!this.config.is12H) {
                return this.filteredTimes.push(this.search)
            }

            this.filteredTimes.push(`${this.search} AM`)
            this.filteredTimes.push(`${this.search} PM`)
        }
    },
    emitInput() {
        let date = ''
        let time = this.input ?? ''

        if (this.hasDate(this.model)) {
            date = this.model.slice(0, 10)
        }

        if (this.config.is12H) {
            time = this.convertTo24Hours(time)
        }

        this.model = `${date} ${time}`.trim()
    },
    convertTo24Hours(time12h) {
        if (!time12h) return ''

        const [time = '00', period = 'AM'] = time12h.split(' ')
        let [hours = '00', minutes = '00'] = time.split(':')

        if (hours === '12') {
            hours = '00'
        }

        if (period === 'PM') {
          hours = (parseInt(hours, 10) + 12).toString()
        }

        hours   = hours.padStart(2, '0')
        minutes = minutes.padEnd(2, '0')

        return `${hours}:${minutes}`
    },
    convertTo12Hours(time24) {
        if (!time24) return ''

        let [hours24 = '12', minutes = '00'] = time24.split(':')
        const period = Number(hours24) < 12 ? 'AM' : 'PM'
        const hours  = Number(hours24) % 12 || 12

        return `${hours}:${minutes.padEnd(2, '0')} ${period}`
    },
    convertModelTime(dateTime) {
        if (!dateTime) return ''

        const time = this.getTimeFromDate(dateTime)

        return this.config.is12H
            ? this.convertTo12Hours(time)
            : time
    },
    hasDate(value) { return /\d{4}-\d{2}-\d{2}/.test(value) },
    hasTime(value) { return /\d{2}:\d{2}/.test(value) },
    getTimeFromDate(dateTime) {
        if (!dateTime) return

        const separator = dateTime?.includes('T') ? 'T' : ' '
        const time      = dateTime.split(separator).pop()

        if (this.hasDate(time)) { return '' }

        return time.slice(0, 5)
    },
    getFocusables() { return [...this.$el.querySelectorAll('li, input')] },
    getFirstFocusable() { return this.getFocusables().shift() },
    getLastFocusable() { return this.getFocusables().pop() },
    getNextFocusable() { return this.getFocusables()[this.getNextFocusableIndex()] || this.getFirstFocusable() },
    getPrevFocusable() { return this.getFocusables()[this.getPrevFocusableIndex()] || this.getLastFocusable() },
    getNextFocusableIndex() { return (this.getFocusables().indexOf(document.activeElement) + 1) % (this.getFocusables().length + 1) },
    getPrevFocusableIndex() { return Math.max(0, this.getFocusables().indexOf(document.activeElement)) -1 },
}"
x-init="function() {
    this.input = this.convertModelTime(this.model)

    $watch('model', value => {
        const time  = this.getTimeFromDate(value)
        const input = this.config.is12H ? this.convertTo24Hours(this.input) : this.input

        if (time !== input) {
            this.input = this.maskInput(time)
        }
    })
}"
x-on:keydown.tab.prevent="$event.shiftKey || getNextFocusable().focus()"
x-on:keydown.arrow-down.prevent="$event.shiftKey || getNextFocusable().focus()"
x-on:keydown.shift.tab.prevent="getPrevFocusable().focus()"
x-on:keydown.arrow-up.prevent="getPrevFocusable().focus()"
class="w-full relative">
    <div class="relative">
        <x-input {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model']) }}
            :borderless="$borderless"
            :shadowless="$shadowless"
            :label="$label"
            :hint="$hint"
            :corner-hint="$cornerHint"
            :icon="$icon"
            :prefix="$prefix"
            :prepend="$prepend"
            x-model="input"
            x-on:input.debounce.150ms="onInput($event.target.value)"
            x-on:blur="emitInput"
        >
            <x-slot name="append">
                <div class="absolute inset-y-0 right-3 z-5 flex items-center justify-center">
                    <div class="flex items-center gap-x-2 my-auto
                        {{ ($errors->has($name) ?? false)
                            ? 'text-negative-400 dark:text-negative-600'
                            :'text-secondary-400'
                        }}">
                        <x-icon class="cursor-pointer w-4 h-4 hover:text-negative-500 transition-colors ease-in-out duration-150"
                            x-cloak
                            name="x"
                            x-show="!config.readonly && !config.disabled && input"
                            x-on:click="clearInput()"
                        />
                        <x-icon class="cursor-pointer w-5 h-5"
                            name="clock"
                            x-show="!config.readonly && !config.disabled"
                            x-on:click="openPicker"
                        />
                    </div>
                </div>
            </x-slot>
        </x-input>
    </div>

    <div class="fixed inset-0 z-10 sm:absolute sm:inset-auto sm:top-0 sm:right-0 sm:mt-6"
        x-cloak
        x-show="showPicker"
        x-on:click.outside="closePicker"
        x-on:keydown.escape.window="closePicker"
        wire:ignore>
        <div class="flex items-end justify-center h-screen sm:h-48"
            style="min-height: -webkit-fill-available; min-height: fill-available;">
            <div class="fixed inset-0 bg-secondary-500 bg-opacity-75 transition-opacity sm:hidden
                      dark:bg-secondary-700 dark:bg-opacity-60"
                x-show="showPicker"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-on:click="closePicker"
                aria-hidden="true">
            </div>

            <div class="w-full rounded-t-md p-2.5 border border-secondary-200 bg-white transform transition-all
                        relative sm:rounded-lg sm:shadow-md sm:w-48 dark:bg-secondary-800 dark:border-secondary-600"
                x-show="showPicker"
                tabindex="-1"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <button class="cursor-pointer hidden sm:flex absolute top-2 right-2 focus:outline-none" x-on:click="closePicker">
                    <x-icon name="x" class="w-4 h-4 text-secondary-400 hover:text-negative-400 transition-all ease-out duration-150" />
                </button>

                <x-input
                    id="search.{{ $attributes->wire('model')->value() }}"
                    label="Select time"
                    x-model="search"
                    ::placeholder="input ?? '12:00'"
                    tabindex="0"
                    x-ref="search"
                    x-on:input.debounce.150ms="onSearch($event.target.value)"
                />

                <ul class="mt-1 w-full h-64 sm:h-32 pb-1 pt-2 overflow-y-auto">
                    <template x-for="time in filteredTimes">
                        <li class="group rounded-md focus:outline-none focus:bg-primary-100 hover:text-white
                                 hover:bg-primary-600 cursor-pointer select-none relative py-2 pl-2 pr-9
                                 dark:hover:bg-secondary-700"
                            :class="{
                                'text-primary-600 dark:text-secondary-400': input === time,
                                'text-secondary-700 dark:text-secondary-400'  : input !== time,
                            }"
                            tabindex="0"
                            x-on:keydown.enter="selectTime(time)"
                            x-on:click="selectTime(time)">
                            <span x-text="time" class="font-normal block truncate"></span>
                            <span class="absolute text-primary-600 group-hover:text-white inset-y-0
                                         right-0 flex items-center pr-4 dark:text-secondary-400"
                                x-show="input === time">
                                <x-icon name="check" class="h-5 w-5" />
                            </span>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</div>
