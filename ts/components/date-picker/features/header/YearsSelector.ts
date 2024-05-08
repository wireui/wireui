import Feature from '@/components/date-picker/features/Feature'
import FluentDate from '@/utils/date'

export type Year = {
  number: number
  isDisabled: boolean
  isSelected: boolean
}

export default class YearsSelector extends Feature {
  year: number = 0

  init (): void {
    const previous = this.previous.bind(this)
    const next = this.next.bind(this)
    const syncCurrentYear = this.syncCurrentYear.bind(this)
    const watchPopover = this.watchPopover.bind(this)

    this.$events.on('previous', previous)
    this.$events.on('next', next)
    this.$events.on('popover', watchPopover)
    this.$events.on('selected::year', syncCurrentYear)

    this.component.$destroy(() => {
      this.$events.off('previous', previous)
      this.$events.off('next', next)
      this.$events.off('popover', watchPopover)
      this.$events.off('selected::year', syncCurrentYear)
    })
  }

  private previous (): void {
    if (this.component.tab !== 'years-picker') return

    this.year -= 15

    if (this.year <= 0) {
      this.year = 1
    }

    this.generate()
  }

  private next (): void {
    if (this.component.tab !== 'years-picker') return

    this.year += 15

    this.generate()
  }

  syncCurrentYear (): void {
    this.component.calendar.years.map((year: Year) => {
      year.isSelected = this.isSelected(year.number)
    })
  }

  watchPopover (state: boolean): void {
    if (state) {
      this.year = this.component.calendar.year

      this.generate()
    }
  }

  private generate (): void {
    const years: Year[] = []

    for (let year = Math.max(1, this.year - 7); year < this.year + 8; year++) {
      years.push({
        number: year,
        isDisabled: this.isDisabled(year),
        isSelected: this.isSelected(year),
      })
    }

    if (years.length < 15) {
      for (let year = years.length + 1; year <= 15; year++) {
        years.push({
          number: year,
          isDisabled: this.isDisabled(year),
          isSelected: this.isSelected(year),
        })
      }
    }

    this.component.calendar.years = years
  }

  private isDisabled (year: number): boolean {
    const allowedDates = this.component.$props.calendar.allowedDates

    if (allowedDates.length) {
      return !allowedDates.some((date: string|string[]) => {
        if (date instanceof Array) {
          const minYear = FluentDate.parse(date[0]).getYear()
          const maxYear = FluentDate.parse(date[1]).getYear()

          const isUnderRange = year >= minYear && year <= maxYear

          if (isUnderRange) return true
        }

        return typeof date === 'string' && FluentDate.parse(date).getYear() === year
      })
    }

    const disabled = this.component.$props.calendar.disabled

    if (disabled.pastDates) {
      if (typeof disabled.pastDates === 'boolean') {
        return FluentDate.now().getYear() > year
      }

      return FluentDate.parse(disabled.pastDates).getYear() > year
    }

    if (disabled.years.length) {
      return disabled.years.some((years: number|number[]) => {
        if (years instanceof Array) {
          return year >= years[0] && year <= years[1]
        }

        return year === years
      })
    }

    const { min, max } = this.component.$props.calendar

    const minYear = min ? FluentDate.parse(min).getYear() : null
    const maxYear = max ? FluentDate.parse(max).getYear() : null

    if (minYear && maxYear) return !(year >= minYear && year <= maxYear)
    if (minYear) return year < minYear
    if (maxYear) return year > maxYear

    return false
  }

  private isSelected (year: number): boolean {
    return this.component.calendar.year === year
  }
}
