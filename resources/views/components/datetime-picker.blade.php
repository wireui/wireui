<div class="relative"
x-data="{
    localeDateConfig: {},
    config: {
        interval: {{ $interval }},
        is12H: @boolean($timeFormat === '12'),
        readonly: @boolean($readonly),
        disabled: @boolean($disabled),
    },
    withoutTimezone: @boolean($withoutTimezone),
    timezone: '{{ $timezone }}',
    userTimezone: '{{ $userTimezone }}',
    localTimezone: $wireui.utils.getLocalTimezone(),
    parseFormat: '{{ $parseFormat }}',
    displayFormat: '{{ $displayFormat }}',
    weekDays: @lang('wireui::messages.datePicker.days'),
    monthNames: @lang('wireui::messages.datePicker.months'),
    searchTime: null,
    input: null,
    modelTime: null,
    model: @entangle($attributes->wire('model')),
    popover: false,
    tab: 'date',
    withoutTime: @boolean($withoutTime),
    monthsPicker: false,
    dates: [],
    times: [],
    filteredTimes: [],
    month: 0,
    year: 0,

    clearDate() { this.model = null },
    togglePicker() {
        if (this.config.readonly || this.config.disabled) return

        this.popover      = !this.popover
        this.monthsPicker = false
    },
    closePicker() {
        this.popover      = false
        this.monthsPicker = false
    },
    handleEscape() {
        if (this.monthsPicker) return this.monthsPicker = false

        this.popover = false
    },
    initComponent() {
        if (!this.userTimezone) {
            this.userTimezone = $wireui.utils.getLocalTimezone()
        }

        this.localeDateConfig = this.getLocaleDateConfig()
        this.syncInput()
        this.syncCalendar()
    },
    syncCalendar() {
        this.year  = this.input.getYear()
        this.month = this.input.getMonth()
    },
    getPreviousDates(currentDate) {
        const dayOfWeek = currentDate.getDayOfWeek()
        const lastMonth = currentDate.clone().subMonth()
        const monthDays = lastMonth.getMonthDays()
        const dates     = []

        for (let day = 0; day < dayOfWeek; day++) {
            dates.unshift({
                month: lastMonth.getMonth(),
                day: monthDays - day
            })
        }

        return dates
    },
    getMonthDates(currentDate) {
        const formatted = currentDate.format('YYYY-MM')
        const monthDays = currentDate.getMonthDays()
        const dates     = []

        for (let day = 1; day <= monthDays; day++) {
            dates.push({
                month: currentDate.getMonth(),
                day,
                isToday: this.isToday(day),
                date: `${formatted}-${day.toString().padStart(2, '0')}`
            })
        }

        return dates
    },
    getNextDates(currentDate, datesLength) {
        const nextMonth = currentDate.clone().addMonth()
        const dates     = []

        for (let day = 1; dates.length + datesLength < 42; day++) {
            dates.push({
                month: nextMonth.getMonth(),
                day: day,
            })
        }

        return dates
    },
    mustSyncDate() {
        if (!this.dates.length) return true

        const inputDate    = this.input.format('YYYY-MM', this.localTimezone)
        const calendarDate = `${this.year}-${String(this.month + 1).padStart(2, '0')}`

        return inputDate !== calendarDate
    },
    syncPickerDates() {
        if (!this.mustSyncDate()) return

        this.syncCalendar()
        this.fillPickerDates()
    },
    fillPickerDates() {
        const date  = $wireui.utils.date(`${this.year}-${this.month + 1}`, this.localTimezone)
        const dates = [...this.getPreviousDates(date), ...this.getMonthDates(date)]
        this.dates  = dates.concat(this.getNextDates(date, dates.length))
    },
    fillTimes() {
        if (this.times.length > 0) return

        const times       = []
        let startTime     = 0
        const timePeriods = ['AM', 'PM']

        for (let i = 0; startTime < 24 * 60; i++) {
            const hour       = Math.floor(startTime / 60).toString().padStart(2, '0')
            let formatedHour = this.config.is12H ? Number(hour % 12) : hour
            const minutes    = Number(startTime % 60).toString().padStart(2, '0')

            if (this.config.is12H && formatedHour === '00') { formatedHour = 12 }

            const time = {
                label: `${formatedHour}:${minutes}`,
                value: `${hour}:${minutes}`
            }

            if (this.config.is12H) {
                time.label += ` ${timePeriods[Math.floor(hour / 12)]}`
            }

            times.push(time)

            startTime += this.config.interval
        }

        this.times         = times
        this.filteredTimes = times
    },
    previousMonth() {
        if (this.month === 0) {
            this.month = 12
            this.year--
        }

        this.month--
        this.fillPickerDates()
    },
    nextMonth() {
        if (this.month === 11) {
            this.month = -1
            this.year++
        }

        this.month++
        this.fillPickerDates()
    },
    isSelected(date) {
        if (!this.model || !date.date) return false

        const model   = $wireui.utils.date(this.model, this.timezone, this.parseFormat)
        const compare = $wireui.utils.date(date.date, this.userTimezone)

        return model.setTimezone(this.userTimezone).isSame(compare, 'date')
    },
    isToday(day) {
        const now = new Date()

        if (this.month !== now.getMonth() || this.year !== now.getFullYear()) {
            return false
        }

        return day === now.getDate()
    },
    selectMonth(month) {
        this.month        = month
        this.monthsPicker = false
        this.fillPickerDates()
    },
    emitInput() {
        this.model = this.input.format(this.parseFormat, this.timezone)
    },
    syncInput() {
        if (this.model && this.input?.format(this.parseFormat ?? 'YYYY-MM-DDTHH:mm:ss.SSSZ') !== this.model) {
            this.input = $wireui.utils.date(this.model, this.timezone, this.parseFormat)
        }

        if (!this.model || this.input.isInvalid()) {
            this.input = $wireui.utils.date(new Date(), this.userTimezone).setTimezone(this.timezone)
        }

        this.modelTime = this.input.getTime(this.userTimezone)
    },
    selectDate(date) {
        this.monthsPicker = false

        this.syncInput()

        if (!this.withoutTimezone) { this.input.setTimezone(this.userTimezone) }

        this.input
            .setYear(this.year)
            .setMonth(date.month)
            .setDay(date.day)

        if (!this.withoutTimezone) { this.input.setTimezone(this.timezone) }

        if (this.month !== date.month) {
            this.month = date.month
            this.fillPickerDates()
        }

        this.emitInput()

        if (!this.withoutTime) { this.tab = 'time' }
        else this.popover = false
    },
    selectTime(time) {
        if (!this.withoutTimezone) { this.input.setTimezone(this.userTimezone) }

        this.input.setTime(time.value)

        if (!this.withoutTimezone) { this.input.setTimezone(this.timezone) }

        this.emitInput()
        this.popover = false
    },
    today() {
        return $wireui.utils.date(new Date(), this.timezone)
    },
    selectYesterday() {
        this.input = this.today().subDay()
        this.closePicker()
        this.emitInput()
    },
    selectToday() {
        this.input = this.today()
        this.closePicker()
        this.emitInput()
    },
    selectTomorrow() {
        this.input = this.today().addDay()
        this.closePicker()
        this.emitInput()
    },
    getLocaleDateConfig() {
        const config = {
            year: 'numeric',
            month: 'numeric',
            day: 'numeric',
            timeZone: this.userTimezone
        }

        if (this.withoutTimezone) { config.timeZone = this.timezone }

        if (!this.withoutTime) {
            config.hour   = 'numeric'
            config.minute = 'numeric'
        }

        return config
    },
    getDisplayValue() {
        if (this.displayFormat) {
            let timezone = this.withoutTimezone
                ? undefined
                : this.userTimezone

            return this.input?.format(this.displayFormat, timezone)
        }

        return this.input
            ?.getNativeDate()
            .toLocaleString(navigator.language, this.localeDateConfig)
    },
    getInputValue() {
        return this.model ? this.getDisplayValue() : null
    },
    onSearchTime(searchTime) {
        const mask         = this.config.is12H ? 'h:m' : 'H:m'
        this.searchTime    = $wireui.utils.mask(mask, searchTime) ?? ''
        this.filteredTimes = this.times.filter(time => time.label.includes(this.searchTime))

        if (this.filteredTimes.length === 0) {
            if (!this.config.is12H) {
                return this.filteredTimes.push({
                    value: this.searchTime,
                    label: this.searchTime
                })
            }

            this.filteredTimes.push({
                value: this.searchTime.padStart(2, '0'),
                label: `${this.searchTime} AM`
            })
            this.filteredTimes.push({
                value: this.searchTime.padStart(2, '0'),
                label: `${this.searchTime} PM`
            })
        }
    },
    focusTime() {
        this.$nextTick(() => {
            this.$refs[`time.${this.modelTime}`]?.scrollIntoView({
                behavior: 'instant',
                block: 'nearest',
                inline: 'center'
            })
        })
    }
}"
x-init="function() {
    this.initComponent()

    $watch('popover', popover => {
        if (popover && !this.dates.length) {
            this.syncPickerDates()

            if (!this.withoutTime) {
                setTimeout(() => this.fillTimes(), 1000)
            }
        }

        if (!popover && this.tab !== 'date') {
            setTimeout(() => this.tab = 'date', 500)
        }
    })

    $watch('tab', tab => {
        if (this.modelTime && this.tab === 'time') {
            this.focusTime()
        }
    })

    $watch('model', model => {
        this.syncInput()
        this.syncPickerDates()
    })
}">
    <x-input {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model']) }}
        :borderless="$borderless"
        :shadowless="$shadowless"
        :label="$label"
        :hint="$hint"
        :corner-hint="$cornerHint"
        :icon="$icon"
        :prefix="$prefix"
        :prepend="$prepend"
        readonly
        x-on:click="togglePicker"
        ::value="getInputValue()">
        @if (!$readonly && !$disabled)
            <x-slot name="append">
                <div class="absolute inset-y-0 right-3 z-5 flex items-center justify-center">
                    <div class="flex items-center gap-x-2 my-auto {{ $errors->has($name) ? 'text-red-400' : 'text-gray-400' }}">
                        <x-icon class="cursor-pointer w-4 h-4 hover:text-red-500 transition-colors ease-in-out duration-150"
                            x-cloak
                            name="x"
                            x-show="model"
                            x-on:click="clearDate()"
                        />
                        <x-icon class="cursor-pointer w-5 h-5" :name="$rightIcon" x-on:click="togglePicker" />
                    </div>
                </div>
            </x-slot>
        @endif
    </x-input>

    <div class="fixed inset-0 z-20 overflow-y-auto sm:absolute sm:inset-auto sm:top-10 sm:mt-1 sm:right-0"
        x-cloak
        style="display: none;"
        x-show="popover"
        x-on:click.away="closePicker"
        x-on:keydown.escape.window="handleEscape">
        <div class="flex items-end justify-center min-h-screen sm:h-96 sm:items-start"
            style="min-height: -webkit-fill-available; min-height: fill-available;">
            <div class="fixed inset-0 bg-gray-400 bg-opacity-60 transition-opacity sm:hidden"
                x-show="popover"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                x-on:click="closePicker"
                aria-hidden="true">
            </div>

            <div class="w-full rounded-t-md border border-gray-200 bg-white transform shadow-lg
                        transition-all relative max-h-96 overflow-y-auto p-3 sm:w-72 sm:rounded-xl"
                x-show="popover"
                tabindex="-1"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <div x-show="tab === 'date'" class="space-y-5">
                    @unless ($withoutTips)
                        <div class="grid grid-cols-3 gap-x-2 text-center text-gray-600">
                            <x-button x-on:click="selectYesterday" class="bg-gray-100 border-none" label="{{__('wireui::messages.datePicker.yesterday')}}" />
                            <x-button x-on:click="selectToday"     class="bg-gray-100 border-none" label="{{__('wireui::messages.datePicker.today')}}" />
                            <x-button x-on:click="selectTomorrow"  class="bg-gray-100 border-none" label="{{__('wireui::messages.datePicker.tomorrow')}}" />
                        </div>
                    @endunless

                    <div class="flex items-center justify-between">
                        <x-button x-show="!monthsPicker" x-on:click="previousMonth" flat icon="chevron-left" class="rounded-lg flex-shrink-0" />

                        <div class="w-full flex items-center justify-center gap-x-2 text-gray-600">
                            <button class="focus:outline-none focus:underline"
                                x-text="monthNames[month]"
                                x-on:click="monthsPicker = !monthsPicker"
                                type="button">
                            </button>
                            <input class="w-10 sm:w-14 appearance-none p-0 ring-0 border-none focus:ring-0 focus:outline-none"
                                x-model="year"
                                x-on:input.debounce.500ms="fillPickerDates"
                                type="number"
                            />
                        </div>

                        <x-button x-show="!monthsPicker" x-on:click="nextMonth" flat icon="chevron-right" class="rounded-lg flex-shrink-0" />
                    </div>

                    <div class="relative">
                        <div x-show.transition="monthsPicker" class="absolute inset-0 bg-white grid grid-cols-3 gap-3">
                            <template x-for="(monthName, index) in monthNames" :key="`month.${monthName}`">
                                <x-button x-on:click="selectMonth(index)" class="text-gray-400 uppercase" xs x-text="monthName" />
                            </template>
                        </div>

                        <div class="grid grid-cols-7 gap-2">
                            <template x-for="day in weekDays" :key="`week-day.${day}`">
                                <span class="text-gray-400 text-2xs text-center uppercase pointer-events-none" x-text="day"></span>
                            </template>

                            <template x-for="date in dates" :key="`week-date.${date.day}.${date.month}`">
                                <div class="flex justify-center picker-days">
                                    <button class="text-sm w-7 h-6 focus:outline-none rounded-md
                                                focus:ring-2 focus:ring-ofsset-2 focus:ring-indigo-600
                                                hover:bg-indigo-100"
                                        :class="{
                                            'text-gray-600': date.month === month && !isSelected(date),
                                            'text-gray-400': date.month !== month,
                                            'text-indigo-600 border border-indigo-600': date.isToday && !isSelected(date),
                                            'text-white bg-indigo-600 font-semibold border border-indigo-600 hover:bg-indigo-600': isSelected(date),
                                        }"
                                        x-on:click="selectDate(date)"
                                        x-text="date.day"
                                        type="button">
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <div x-show.transition="tab === 'time'">
                    <x-input
                        id="search.{{ $attributes->wire('model')->value() }}"
                        label="Select time"
                        x-model="searchTime"
                        ::placeholder="modelTime ?? '12:00'"
                        x-ref="searchTime"
                        x-on:input.debounce.150ms="onSearchTime($event.target.value)"
                    />

                    <div class="mt-1 w-full h-52 pb-1 pt-2 overflow-y-auto flex flex-col picker-times">
                        <template x-for="time in filteredTimes" :key="`time.${time.value}`">
                            <button class="group rounded-md focus:outline-none focus:bg-indigo-100 cursor-pointer select-none
                                            relative py-2 pl-2 pr-9 text-left transition-colors ease-in-out duration-100
                                            hover:text-white hover:bg-indigo-600"
                                :class="{
                                    'text-indigo-600': modelTime === time.value,
                                    'text-gray-700': modelTime !== time.value,
                                }"
                                :x-ref="`time.${time.value}`"
                                type="button"
                                x-on:click="selectTime(time)">
                                <span x-text="time.label"></span>
                                <span class="text-indigo-600 group-hover:text-white absolute inset-y-0 right-0 flex items-center pr-4"
                                    x-show="modelTime === time.value">
                                    <x-icon name="check" class="h-5 w-5" />
                                </span>
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
