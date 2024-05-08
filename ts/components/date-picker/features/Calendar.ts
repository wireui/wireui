import Feature from '@/components/date-picker/features/Feature'
import { Day } from '@/components/date-picker/interfaces'
import FluentDate from '@/utils/date'

export default class Calendar extends Feature {
  init (): void {
    const previous = this.previous.bind(this)
    const next = this.next.bind(this)
    const watchPopover = this.watchPopover.bind(this)
    const refreshCalendar = this.refreshCalendar.bind(this)

    this.$events.on('previous', previous)
    this.$events.on('next', next)
    this.$events.on('popover', watchPopover)
    this.$events.on('selected::year', refreshCalendar)
    this.$events.on('selected::month', refreshCalendar)
    this.$events.on('selected::day', refreshCalendar)

    this.component.$destroy(() => {
      this.$events.off('previous', previous)
      this.$events.off('next', next)
      this.$events.off('popover', watchPopover)
    })
  }

  private previous (): void {
    if (this.component.tab !== 'calendar') return

    this.refreshCalendar()
  }

  private next (): void {
    if (this.component.tab !== 'calendar') return

    this.refreshCalendar()
  }

  private watchPopover (state: boolean): void {
    if (state) {
      this.refreshCalendar()
    }
  }

  private refreshCalendar () {
    this.component.calendar.dates = this.generate()
  }

  private generate (): Day[] {
    const { year, month } = this.component.calendar

    const days: Day[] = []

    const date = FluentDate.now()
      .setYear(year)
      .setMonth(month)
      .setDay(1)

    const subDays = date.getDayOfWeek() - this.component.$props.calendar.startOfWeek

    date.subDays(subDays)

    for (let i = 0; i < 42; i++) {
      days.push({
        date: date.toDateString(),
        year: date.getYear(),
        month: date.getMonth(),
        number: date.getDay(),
        isDisabled: this.isDisabled(date),
        isToday: date.isToday(),
        isSelected: this.isSelected(date),
        isSelectedMonth: date.getMonth() === month,
      })

      date.addDay()
    }

    return days
  }

  private isSelected (day: FluentDate): boolean {
    // if ([12, 13, 14, 15, 16, 16, 17, 18].includes(day.getDay())) return true

    return Boolean(this.component.selected?.isSame(day, 'day'))
  }

  private isDisabled (day: FluentDate): boolean {
    const allowedDates = this.component.$props.calendar.allowedDates

    if (allowedDates.length) {
      return !allowedDates.some((date: string|string[]) => {
        if (date instanceof Array) {
          return day.isBetween(date[0], date[1])
        }

        return day.isSame(date, 'day')
      })
    }

    const disabled = this.component.$props.calendar.disabled

    if (disabled.pastDates) {
      if (typeof disabled.pastDates === 'boolean') {
        return day.isBefore(FluentDate.now(), 'day')
      }

      return day.isSameOrBefore(disabled.pastDates, 'day')
    }

    if (disabled.dates.length) {
      return disabled.dates.some((date: string|string[]) => {
        if (date instanceof Array) {
          return day.isBetween(date[0], date[1])
        }

        return day.isSame(date, 'day')
      })
    }

    if (disabled.weekdays.length) {
      return disabled.weekdays.includes(day.getDayOfWeek())
    }

    if (disabled.months.length) {
      return disabled.months.includes(day.getRealMonth())
    }

    if (disabled.years.length) {
      return disabled.years.some((year: number|number[]) => {
        if (year instanceof Array) {
          return day.getYear() >= year[0] && day.getYear() <= year[1]
        }

        return day.getYear() === year
      })
    }

    const { min, max } = this.component.$props.calendar

    if (min && max) return day.isBetween(min, 'day')
    if (min) return day.isBefore(min, 'day')
    if (max) return day.isAfter(max, 'day')

    return false
  }
}
