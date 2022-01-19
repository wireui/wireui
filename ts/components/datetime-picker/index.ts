import { applyMask } from '../../utils/masker'
import { getLocalTimezone, date as parseDate } from '../../utils/date'
import { CurrentDate, DateTimePicker, InitOptions, LocaleDateConfig, NextDate, PreviousDate } from './interfaces'
import { makeTimes, Time } from './makeTimes'
import { convertStandardTimeToMilitary } from '../../utils/time'

export default (options: InitOptions): DateTimePicker => ({
  model: options.model,
  config: options.config,
  withoutTimezone: options.withoutTimezone,
  timezone: options.timezone,
  userTimezone: options.userTimezone,
  localTimezone: getLocalTimezone(),
  parseFormat: options.parseFormat ?? 'YYYY-MM-DDTHH:mm:ss.SSSZ',
  displayFormat: options.displayFormat,
  weekDays: options.weekDays,
  monthNames: options.monthNames,
  withoutTime: options.withoutTime,
  localeDateConfig: {
    year: undefined,
    month: undefined,
    day: undefined,
    timeZone: undefined
  },
  searchTime: null,
  input: null,
  modelTime: null,
  popover: false,
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
    this.initComponent()

    this.$watch('popover', popover => {
      if (popover && !this.currentDates.length) {
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
      this.syncPickerDates(true)
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
  clearDate () {
    this.model = null
  },
  togglePicker () {
    if (this.config.readonly || this.config.disabled) return

    if (this.config.min && !this.minDate) {
      this.minDate = parseDate(this.config.min, this.timezone)

      if (!this.withoutTimezone) {
        this.minDate.setTimezone(this.userTimezone)
      }
    }

    if (this.config.max && !this.maxDate) {
      this.maxDate = parseDate(this.config.max, this.timezone)

      if (!this.withoutTimezone) {
        this.maxDate.setTimezone(this.userTimezone)
      }
    }

    this.popover = !this.popover
    this.monthsPicker = false
  },
  closePicker () {
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
  mustSyncDate () {
    if (!this.currentDates.length) return true

    const inputDate = this.input?.format('YYYY-MM', this.localTimezone)
    const calendarDate = `${this.year}-${String(this.month + 1).padStart(2, '0')}`

    return inputDate !== calendarDate
  },
  syncPickerDates (forceSync = false) {
    if (!this.mustSyncDate() && !forceSync) return

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

    const times = makeTimes(this.config.is12H, this.config.interval)
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
  emitInput () {
    this.model = this.input?.format(this.parseFormat, this.timezone)
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

    this.emitInput()

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

    this.emitInput()
    this.popover = false
  },
  today () {
    return parseDate(new Date(), this.timezone)
  },
  selectYesterday () {
    this.input = this.today().subDay()
    this.closePicker()
    this.emitInput()
  },
  selectToday () {
    this.input = this.today()
    this.closePicker()
    this.emitInput()
  },
  selectTomorrow () {
    this.input = this.today().addDay()
    this.closePicker()
    this.emitInput()
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
          behavior: 'instant',
          block: 'nearest',
          inline: 'center'
        })
    })
  }
})
