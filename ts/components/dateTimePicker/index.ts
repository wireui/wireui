import { applyMask } from '../../utils/masker'
import { getLocalTimezone, date as parseDate } from '../../utils/date'
import { CurrentDate, DateTimePicker, InitOptions, LocaleDateConfig, NextDate, PreviousDate } from './interfaces'
import { makeTimes } from './makeTimes'

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
      if (this.modelTime && this.tab === 'time') {
        this.focusTime()
      }
    })

    this.$watch('model', () => {
      this.syncInput()
      this.syncPickerDates()
    })
  },
  clearDate () {
    this.model = null
  },
  togglePicker () {
    if (this.config.readonly || this.config.disabled) return

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
  initComponent () {
    if (!this.userTimezone) {
      this.userTimezone = getLocalTimezone()
    }

    this.localeDateConfig = this.getLocaleDateConfig()
    this.syncInput()
    this.syncCalendar()
  },
  syncCalendar () {
    if (!this.input?.getYear || !this.input?.getMonth) return

    this.year = this.input.getYear()
    this.month = this.input.getMonth()
  },
  getPreviousDates (currentDate) {
    const dayOfWeek = currentDate.getDayOfWeek()
    const lastMonth = currentDate.clone().subMonth()
    const monthDays = lastMonth.getMonthDays()
    const dates: PreviousDate[] = []

    for (let day = 0; day < dayOfWeek; day++) {
      dates.unshift({
        month: lastMonth.getMonth(),
        day: monthDays - day
      })
    }

    return dates
  },
  getCurrentDates (currentDate) {
    const formatted = currentDate.format('YYYY-MM')
    const monthDays = currentDate.getMonthDays()
    const dates: CurrentDate[] = []

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
  getNextDates (currentDate, datesLength) {
    const nextMonth = currentDate.clone().addMonth()
    const dates: NextDate[] = []

    for (let day = 1; dates.length + datesLength < 42; day++) {
      dates.push({
        month: nextMonth.getMonth(),
        day
      })
    }

    return dates
  },
  mustSyncDate () {
    if (!this.currentDates.length) return true

    const inputDate = this.input?.format('YYYY-MM', this.localTimezone)
    const calendarDate = `${this.year}-${String(this.month + 1).padStart(2, '0')}`

    return inputDate !== calendarDate
  },
  syncPickerDates () {
    if (!this.mustSyncDate()) return

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
    if (!this.model || !date.date) return false

    const model = parseDate(this.model, this.timezone, this.parseFormat)
    const compare = parseDate(date.date, this.userTimezone)

    return model.setTimezone(this.userTimezone).isSame(compare, 'date')
  },
  isToday (date) {
    const now = new Date()

    if (this.month !== now.getMonth() || this.year !== now.getFullYear()) {
      return false
    }

    return date.getDay() === now.getDate()
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
    this.monthsPicker = false

    this.syncInput()

    if (!this.withoutTimezone) { this.input?.setTimezone(this.userTimezone) }

    this.input
      ?.setYear(this.year)
      .setMonth(date.month)
      .setDay(date.day)

    if (!this.withoutTimezone) { this.input?.setTimezone(this.timezone) }

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
    this.filteredTimes = this.times.filter(time => time.label.includes(this.searchTime ?? ''))

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
  focusTime () {
    this.$nextTick(() => {
      this.$refs
        .timesContainer
        .querySelector(`button[name = 'time.${this.modelTime}']`)
        ?.scrollIntoView({
          behavior: 'instant',
          block: 'nearest',
          inline: 'center'
        })
    })
  }
})
