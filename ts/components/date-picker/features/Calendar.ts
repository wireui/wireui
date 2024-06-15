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

  refreshCalendar () {
    this.component.calendar.dates = this.generate()
  }

  private generate (): Day[] {
    if (this.component.positionable.isClosed()) return []

    const { year, month } = this.component.calendar

    const days: Day[] = []

    const date = FluentDate.now()
      .setYear(year)
      .setMonth(month)
      .setDay(1)

    const subDays = date.getDayOfWeek() - this.component.$props.calendar.startOfWeek

    date.subDays(subDays)

    for (let i = 0; i < 42; i++) {
      days.push(
        this.component.fluentDateToDay(date)
      )

      date.addDay()
    }

    return days
  }
}
