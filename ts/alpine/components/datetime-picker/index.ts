import { AlpineComponent } from '@/alpine/components/alpine'
import Positioning from '@/alpine/components/modules/Positioning'
import Entangleable from '@/alpine/entangleable'
import { watchProps } from '@/alpine/magic/props'
import { date as parseDate, Dateable, getLocalTimezone } from '@/utils/date'
import { applyMask } from '@/utils/masker'
import { convertStandardTimeToMilitary } from '@/utils/time'
import { CurrentDate, iDate, LocaleDateConfig, NextDate, PreviousDate, Props, Refs } from './interfaces'
import { makeTimes, Time } from './makeTimes'

export default class DateTimePicker extends AlpineComponent {
  declare $refs: Refs

  $props!:Props

  positioning!: Positioning

  entangleable: Entangleable = new Entangleable()

  localTimezone: string = getLocalTimezone()

  localeDateConfig: LocaleDateConfig = {
    year: undefined,
    month: undefined,
    day: undefined,
    timeZone: undefined
  }

  searchTime: string | null = null

  input: Dateable | null = null

  modelTime: string | null | undefined = null

  tab: 'date' | 'time' = 'date'

  monthsPicker: boolean = false

  previousDates: PreviousDate[] = []

  currentDates:CurrentDate[] = []

  nextDates:NextDate[] = []

  times: Time[] = []

  filteredTimes:Time[] = []

  month:number = 0

  year:number = 0

  minDate:  Dateable | null = null

  maxDate:  Dateable | null = null

  get userTimezone (): string {
    if (this.$props.userTimezone) {
      return this.$props.userTimezone
    }

    return this.localTimezone
  }

  get dates (): iDate[] {
    return [...this.previousDates, ...this.currentDates, ...this.nextDates]
  }

  init () {
    watchProps(this, this.onPropsChange.bind(this))

    this.onPropsChange()
    this.initComponent()

    this.positioning = new Positioning(this.$root, this.$refs.popover).start()
    this.positioning.watch((state: boolean) => {
      if (state) {
        this.syncPickerDates()

        if (!this.$props.withoutTime) {
          setTimeout(() => this.fillTimes(), 1000)
        }
      }

      if (!state && this.tab !== 'date') {
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

    this.entangleable.watch(() => {
      this.syncInput()
      this.syncPickerDates()
    })

    this.entangleable.onClear(() => {
      this.syncInput()
      this.syncPickerDates()
    })
  }

  initComponent () {
    this.localeDateConfig = this.getLocaleDateConfig()
    this.syncInput()
    this.syncCalendar()
  }

  onPropsChange () {
    this.syncDateLimits()

    if (this.state) {
      this.syncPickerDates()
    }
  }

  syncDateLimits () {
    this.minDate = null
    this.maxDate = null

    if (this.$props.config.min) {
      this.minDate = parseDate(this.$props.config.min, this.$props.timezone)

      if (!this.$props.withoutTimezone) {
        this.minDate.setTimezone(this.userTimezone)
      }
    }

    if (this.$props.config.max) {
      this.maxDate = parseDate(this.$props.config.max, this.$props.timezone)

      if (!this.$props.withoutTimezone) {
        this.maxDate.setTimezone(this.userTimezone)
      }
    }
  }

  clearDate () {
    this.entangleable.clear()
  }

  toggle () {
    if (this.$props.config.readonly || this.$props.config.disabled) return

    this.syncDateLimits()

    this.state = !this.state
    this.monthsPicker = false
  }

  close () {
    this.state = false
    this.monthsPicker = false
  }

  handleEscape () {
    if (this.monthsPicker) return (this.monthsPicker = false)

    this.state = false
  }

  syncCalendar () {
    if (!this.input?.getYear || !this.input?.getMonth) return

    this.year = this.input.getYear()
    this.month = this.input.getMonth()
  }

  getPreviousDates (currentDate: Dateable): PreviousDate[] {
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
  }

  getCurrentDates (currentDate: Dateable): CurrentDate[] {
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
  }

  getNextDates (currentDate: Dateable, datesLength: number): NextDate[] {
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
  }

  isDateDisabled (date: iDate) {
    const compareDate = `${date.year}-${date.month + 1}-${date.day}`

    if (!this.minDate?.isSame(compareDate, 'date') && this.minDate?.isAfter(compareDate)) {
      return true
    }

    if (!this.maxDate?.isSame(compareDate, 'date') && this.maxDate?.isBefore(compareDate)) {
      return true
    }

    return false
  }

  syncPickerDates () {
    this.syncCalendar()
    this.fillPickerDates()
  }

  fillPickerDates () {
    const date = parseDate(`${this.year}-${this.month + 1}`, this.localTimezone)

    this.previousDates = this.getPreviousDates(date)
    this.currentDates = this.getCurrentDates(date)
    this.nextDates = this.getNextDates(date, this.previousDates.length + this.currentDates.length)
  }

  fillTimes () {
    if (this.times.length > 0) return

    const times = makeTimes({
      time12H: this.$props.config.is12H,
      interval: this.$props.config.interval,
      min: this.$props.config.minTime,
      max: this.$props.config.maxTime
    })

    this.times = times
    this.filteredTimes = times
  }

  filterTimes (times: Time[]): Time[] {
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
  }

  previousMonth () {
    if (this.month === 0) {
      this.month = 12
      this.year--
    }

    this.month--
    this.fillPickerDates()
  }

  nextMonth () {
    if (this.month === 11) {
      this.month = -1
      this.year++
    }

    this.month++
    this.fillPickerDates()
  }

  isSelected (date: CurrentDate): boolean {
    if (this.entangleable.isEmpty()) return false

    const model = parseDate(this.entangleable.get(), this.$props.timezone, this.$props.parseFormat)
    const compare = parseDate(date.date, this.userTimezone)

    return model.setTimezone(this.userTimezone).isSame(compare, 'date')
  }

  isToday (day: number): boolean {
    const now = new Date()

    if (this.month !== now.getMonth() || this.year !== now.getFullYear()) {
      return false
    }

    return day === now.getDate()
  }

  selectMonth (month: number) {
    this.month = month
    this.monthsPicker = false
    this.fillPickerDates()
  }

  syncWireModel () {
    let date = this.input?.format(this.$props.parseFormat, this.$props.timezone)

    if (date && this.$props.withoutTime && !this.$props.parseFormat) {
      date = date.slice(0, 10)
    }

    this.entangleable.set(date)
  }

  syncInput () {
    const value = this.entangleable.get()

    if (value && this.input?.format(this.$props.parseFormat) !== value) {
      this.input = parseDate(value, this.$props.timezone, this.$props.parseFormat)
    }

    if (!value || this.input?.isInvalid()) {
      this.input = parseDate(new Date(), this.userTimezone).setTimezone(this.$props.timezone)
    }

    this.modelTime = this.input?.getTime(this.userTimezone)
  }

  selectDate (date: iDate) {
    if (date.isDisabled) return

    this.monthsPicker = false

    this.syncInput()

    if (!this.$props.withoutTimezone) {
      this.input?.setTimezone(this.userTimezone)
    }

    this.input
      ?.setYear(date.year)
      .setMonth(date.month)
      .setDay(date.day)

    if (!this.$props.withoutTimezone) {
      this.input?.setTimezone(this.$props.timezone)
    }

    if (this.month !== date.month) {
      this.month = date.month
      this.fillPickerDates()
    }

    this.syncWireModel()

    !this.$props.withoutTime
      ? this.tab = 'time'
      : this.state = false
  }

  selectTime (time: iDate) {
    if (!this.$props.withoutTimezone) {
      this.input?.setTimezone(this.userTimezone)
    }

    this.input?.setTime(time.value)

    if (!this.$props.withoutTimezone) {
      this.input?.setTimezone(this.$props.timezone)
    }

    this.syncWireModel()
    this.state = false
  }

  today (): Dateable {
    return parseDate(new Date(), this.$props.timezone)
  }

  selectYesterday () {
    this.input = this.today().subDay()
    this.close()
    this.syncWireModel()
  }

  selectToday () {
    this.input = this.today()
    this.close()
    this.syncWireModel()
  }

  selectTomorrow () {
    this.input = this.today().addDay()
    this.close()
    this.syncWireModel()
  }

  getLocaleDateConfig (): LocaleDateConfig {
    const config: LocaleDateConfig = {
      year: 'numeric',
      month: 'numeric',
      day: 'numeric',
      timeZone: this.userTimezone
    }

    if (this.$props.withoutTimezone) {
      config.timeZone = this.$props.timezone
    }

    if (!this.$props.withoutTime) {
      config.hour = 'numeric'
      config.minute = 'numeric'
    }

    return config
  }

  getDisplayValue () {
    if (this.$props.displayFormat) {
      const timezone = this.$props.withoutTimezone
        ? undefined
        : this.userTimezone

      return this.input?.format(this.$props.displayFormat, timezone)
    }

    return this.input
      ?.getNativeDate()
      .toLocaleString(navigator.language, this.localeDateConfig)
  }

  getSearchPlaceholder () {
    if (this.$props.config.is12H) {
      return this.input?.format('h:mm a', this.userTimezone) ?? '12:00 AM'
    }

    return this.modelTime ? this.modelTime : '12:00'
  }

  onSearchTime (search: string) {
    const mask = this.$props.config.is12H ? 'h:m' : 'H:m'
    this.searchTime = applyMask(mask, search) ?? ''
    this.filteredTimes = this.filterTimes(
      this.times.filter(time => time.label.includes(this.searchTime ?? ''))
    )

    if (this.filteredTimes.length > 0) return

    this.filteredTimes = this.makeSearchTimes(this.searchTime)
  }

  makeSearchTimes (search: string) {
    const times: Time[] = []

    if (!this.$props.config.is12H) {
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
  }

  focusTime () {
    this.$nextTick(() => {

      this.$refs
        .timesContainer
        .querySelector(`button[name = 'times.${this.input?.getTime(this.$props.userTimezone)}']`)
        ?.scrollIntoView({
          behavior: 'auto',
          block: 'center',
          inline: 'center'
        })
    })
  }
}
