import { applyMask } from '@/utils/masker'
import { getLocalTimezone, date as parseDate } from '@/utils/date'
import { CurrentDate, DateTimePicker, InitOptions, LocaleDateConfig, NextDate, PreviousDate, Props, Refs } from './interfaces'
import { makeTimes, Time } from './makeTimes'
import { convertStandardTimeToMilitary } from '@/utils/time'
import { baseComponent } from '@/components/alpine'
import { positioning } from '@/components/modules/positioning'
import { watchProps } from '@/alpine/magic/props'

export default (options: InitOptions): DateTimePicker => ({
  ...baseComponent,
  ...positioning,
  $refs: {} as Refs,
  $props: {} as Props,
  model: options.model,
  config: {
    interval: 10,
    is12H: false,
    readonly: false,
    disabled: false,
    min: undefined,
    max: undefined,
    minTime: undefined,
    maxTime: undefined
  },
  withoutTimezone: false,
  timezone: '',
  userTimezone: '',
  localTimezone: getLocalTimezone(),
  parseFormat: '',
  displayFormat: '',
  weekDays: [],
  monthNames: [],
  withoutTime: false,
  localeDateConfig: {
    year: undefined,
    month: undefined,
    day: undefined,
    timeZone: undefined
  },
  searchTime: null,
  input: null,
  modelTime: null,
  tab: 'date',
  monthsPicker: false,
  previousDates: [],
  currentDates: [],
  nextDates: [],
  times: [],
  filteredTimes: [],
  month: 0,
  year: 0,
  minDate: null,
  maxDate: null,

  get dates () {
    return [...this.previousDates, ...this.currentDates, ...this.nextDates]
  },

  init () {
    watchProps(this, this.syncProps.bind(this))
    this.syncProps()
    this.initComponent()
    this.initPositioningSystem()

    this.$watch('popover', popover => {
      if (popover) {
        this.syncPickerDates()

        if (!this.withoutTime) {
          setTimeout(() => this.fillTimes(), 1000)
        }
      }

      if (!popover && this.tab !== 'date') {
        setTimeout(() => (this.tab = 'date'), 500)
      }
    })

    this.$watch('tab', () => {
      if (this.tab === 'time') {
        this.filteredTimes = this.filterTimes(this.times)
      }

      if (this.modelTime && this.tab === 'time') {
        this.focusTime()
      }
    })

    this.$watch('model', () => {
      this.syncInput()
      this.syncPickerDates()
    })
  },
  initComponent () {
    if (!this.userTimezone) {
      this.userTimezone = getLocalTimezone()
    }

    this.localeDateConfig = this.getLocaleDateConfig()
    this.syncInput()
    this.syncCalendar()
  },
  syncProps () {
    const props = this.$props

    this.config = {
      interval: props.config.interval,
      is12H: props.config.is12H,
      readonly: props.config.readonly,
      disabled: props.config.disabled,
      min: props.config.min,
      max: props.config.max,
      minTime: props.config.minTime,
      maxTime: props.config.maxTime
    }

    this.withoutTimezone = props.withoutTimezone
    this.timezone = props.timezone
    this.userTimezone = props.userTimezone
    this.parseFormat = props.parseFormat
    this.displayFormat = props.displayFormat
    this.weekDays = props.weekDays
    this.monthNames = props.monthNames
    this.withoutTime = props.withoutTime

    if (!this.userTimezone) {
      this.userTimezone = getLocalTimezone()
    }

    this.syncDateLimits()

    if (this.popover) {
      this.syncPickerDates()
    }
  },
  syncDateLimits () {
    this.minDate = null
    this.maxDate = null

    if (this.config.min) {
      this.minDate = parseDate(this.config.min, this.timezone)

      if (!this.withoutTimezone) {
        this.minDate.setTimezone(this.userTimezone)
      }
    }

    if (this.config.max) {
      this.maxDate = parseDate(this.config.max, this.timezone)

      if (!this.withoutTimezone) {
        this.maxDate.setTimezone(this.userTimezone)
      }
    }
  },
  clearDate () {
    this.model = null
  },
  toggle () {
    if (this.config.readonly || this.config.disabled) return

    this.syncDateLimits()

    this.popover = !this.popover
    this.monthsPicker = false
  },
  close () {
    this.popover = false
    this.monthsPicker = false
  },
  handleEscape () {
    if (this.monthsPicker) return (this.monthsPicker = false)

    this.popover = false
  },
  syncCalendar () {
    if (!this.input?.getYear || !this.input?.getMonth) return

    this.year = this.input.getYear()
    this.month = this.input.getMonth()
  },
  getPreviousDates (currentDate) {
    const dayOfWeek = currentDate.getDayOfWeek()
    const previousDate = currentDate.clone().subMonth()
    const monthDays = previousDate.getMonthDays()
    const dates: PreviousDate[] = []

    for (let day = 0; day < dayOfWeek; day++) {
      const date: PreviousDate = {
        year: previousDate.getYear(),
        month: previousDate.getMonth(),
        day: monthDays - day,
        isDisabled: false
      }

      date.isDisabled = this.isDateDisabled(date)

      dates.unshift(date)
    }

    return dates
  },
  getCurrentDates (currentDate) {
    const formatted = currentDate.format('YYYY-MM')
    const monthDays = currentDate.getMonthDays()
    const dates: CurrentDate[] = []

    for (let day = 1; day <= monthDays; day++) {
      const date: CurrentDate = {
        year: currentDate.getYear(),
        month: currentDate.getMonth(),
        day,
        isToday: this.isToday(day),
        date: `${formatted}-${day.toString().padStart(2, '0')}`,
        isSelected: false,
        isDisabled: false
      }

      date.isSelected = this.isSelected(date)
      date.isDisabled = this.isDateDisabled(date)
      dates.push(date)
    }

    return dates
  },
  getNextDates (currentDate, datesLength) {
    const nextDate = currentDate.clone().addMonth()
    const dates: NextDate[] = []

    for (let day = 1; dates.length + datesLength < 42; day++) {
      const date: NextDate = {
        year: nextDate.getYear(),
        month: nextDate.getMonth(),
        day,
        isDisabled: false
      }

      date.isDisabled = this.isDateDisabled(date)
      dates.push(date)
    }

    return dates
  },
  isDateDisabled (date) {
    const compareDate = `${date.year}-${date.month + 1}-${date.day}`

    if (!this.minDate?.isSame(compareDate, 'date') && this.minDate?.isAfter(compareDate)) {
      return true
    }

    if (!this.maxDate?.isSame(compareDate, 'date') && this.maxDate?.isBefore(compareDate)) {
      return true
    }

    return false
  },
  syncPickerDates () {
    this.syncCalendar()
    this.fillPickerDates()
  },
  fillPickerDates () {
    const date = parseDate(`${this.year}-${this.month + 1}`, this.localTimezone)

    this.previousDates = this.getPreviousDates(date)
    this.currentDates = this.getCurrentDates(date)
    this.nextDates = this.getNextDates(date, this.previousDates.length + this.currentDates.length)
  },
  fillTimes () {
    if (this.times.length > 0) return

    const times = makeTimes({
      time12H: this.config.is12H,
      interval: this.config.interval,
      min: this.config.minTime,
      max: this.config.maxTime
    })

    this.times = times
    this.filteredTimes = times
  },
  filterTimes (times) {
    if (this.minDate && this.input && this.minDate.isSame(this.input, 'date')) {
      return times.filter(time => {
        return Number(time.value.replace(':', '')) >= Number(this.minDate?.getTime().replace(':', ''))
      })
    }

    if (this.maxDate && this.input && this.maxDate.isSame(this.input, 'date')) {
      return times.filter(time => {
        return Number(time.value.replace(':', '')) <= Number(this.maxDate?.getTime().replace(':', ''))
      })
    }

    return times
  },
  previousMonth () {
    if (this.month === 0) {
      this.month = 12
      this.year--
    }

    this.month--
    this.fillPickerDates()
  },
  nextMonth () {
    if (this.month === 11) {
      this.month = -1
      this.year++
    }

    this.month++
    this.fillPickerDates()
  },
  isSelected (date) {
    if (!this.model) return false

    const model = parseDate(this.model, this.timezone, this.parseFormat)
    const compare = parseDate(date.date, this.userTimezone)

    return model.setTimezone(this.userTimezone).isSame(compare, 'date')
  },
  isToday (day) {
    const now = new Date()

    if (this.month !== now.getMonth() || this.year !== now.getFullYear()) {
      return false
    }

    return day === now.getDate()
  },
  selectMonth (month) {
    this.month = month
    this.monthsPicker = false
    this.fillPickerDates()
  },
  syncWireModel () {
    let date = this.input?.format(this.parseFormat, this.timezone)

    if (date && this.withoutTime && !this.parseFormat) {
      date = date.slice(0, 10)
    }

    this.model = date
  },
  syncInput () {
    if (this.model && this.input?.format(this.parseFormat) !== this.model) {
      this.input = parseDate(this.model, this.timezone, this.parseFormat)
    }

    if (!this.model || this.input?.isInvalid()) {
      this.input = parseDate(new Date(), this.userTimezone).setTimezone(this.timezone)
    }

    this.modelTime = this.input?.getTime(this.userTimezone)
  },
  selectDate (date) {
    if (date.isDisabled) return

    this.monthsPicker = false

    this.syncInput()

    if (!this.withoutTimezone) {
      this.input?.setTimezone(this.userTimezone)
    }

    this.input
      ?.setYear(date.year)
      .setMonth(date.month)
      .setDay(date.day)

    if (!this.withoutTimezone) {
      this.input?.setTimezone(this.timezone)
    }

    if (this.month !== date.month) {
      this.month = date.month
      this.fillPickerDates()
    }

    this.syncWireModel()

    !this.withoutTime
      ? this.tab = 'time'
      : this.popover = false
  },
  selectTime (time) {
    if (!this.withoutTimezone) {
      this.input?.setTimezone(this.userTimezone)
    }

    this.input?.setTime(time.value)

    if (!this.withoutTimezone) {
      this.input?.setTimezone(this.timezone)
    }

    this.syncWireModel()
    this.popover = false
  },
  today () {
    return parseDate(new Date(), this.timezone)
  },
  selectYesterday () {
    this.input = this.today().subDay()
    this.close()
    this.syncWireModel()
  },
  selectToday () {
    this.input = this.today()
    this.close()
    this.syncWireModel()
  },
  selectTomorrow () {
    this.input = this.today().addDay()
    this.close()
    this.syncWireModel()
  },
  getLocaleDateConfig () {
    const config: LocaleDateConfig = {
      year: 'numeric',
      month: 'numeric',
      day: 'numeric',
      timeZone: this.userTimezone
    }

    if (this.withoutTimezone) {
      config.timeZone = this.timezone
    }

    if (!this.withoutTime) {
      config.hour = 'numeric'
      config.minute = 'numeric'
    }

    return config
  },
  getDisplayValue () {
    if (this.displayFormat) {
      const timezone = this.withoutTimezone
        ? undefined
        : this.userTimezone

      return this.input?.format(this.displayFormat, timezone)
    }

    return this.input
      ?.getNativeDate()
      .toLocaleString(navigator.language, this.localeDateConfig)
  },
  getSearchPlaceholder () {
    if (this.config.is12H) {
      return this.input?.format('h:mm a', this.userTimezone) ?? '12:00 AM'
    }

    return this.modelTime ? this.modelTime : '12:00'
  },
  onSearchTime (search) {
    const mask = this.config.is12H ? 'h:m' : 'H:m'
    this.searchTime = applyMask(mask, search) ?? ''
    this.filteredTimes = this.filterTimes(
      this.times.filter(time => time.label.includes(this.searchTime ?? ''))
    )

    if (this.filteredTimes.length > 0) return

    this.filteredTimes = this.makeSearchTimes(this.searchTime)
  },
  makeSearchTimes (search) {
    const times: Time[] = []

    if (!this.config.is12H) {
      times.push({
        value: search.padEnd(5, '0'),
        label: search.padEnd(5, '0')
      })

      return this.filterTimes(times)
    }

    times.push({
      value: convertStandardTimeToMilitary(`${search} AM`),
      label: `${search} AM`
    })

    times.push({
      value: convertStandardTimeToMilitary(`${search} PM`),
      label: `${search} PM`
    })

    return this.filterTimes(times)
  },
  focusTime () {
    this.$nextTick(() => {
      this.$refs
        .timesContainer
        .querySelector(`button[name = 'times.${this.input?.getTime(this.userTimezone)}']`)
        ?.scrollIntoView({
          behavior: 'auto',
          block: 'center',
          inline: 'center'
        })
    })
  }
})
