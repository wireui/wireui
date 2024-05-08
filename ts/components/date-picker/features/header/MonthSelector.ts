import Feature from '@/components/date-picker/features/Feature'
import { Tab } from '@/components/date-picker/interfaces'

export default class MonthSelector extends Feature {
  init (): void {
    const previous = this.previous.bind(this)
    const next = this.next.bind(this)

    this.component.$events.on('previous', previous)
    this.component.$events.on('next', next)

    this.component.$destroy(() => {
      this.component.$events.off('previous', previous)
      this.component.$events.off('next', next)
    })
  }

  private previous (): void {
    if (!this.shouldExecute(this.component.tab)) return

    this.component.calendar.month--

    if (this.component.calendar.month < 0) {
      this.component.calendar.month = 11
      this.component.calendar.year--
    }
  }

  private next (): void {
    if (!this.shouldExecute(this.component.tab)) return

    this.component.calendar.month++

    if (this.component.calendar.month > 11) {
      this.component.calendar.month = 0
      this.component.calendar.year++
    }
  }

  private shouldExecute (tab: Tab): boolean {
    const allowedTabs: Tab[] = ['calendar', 'months-picker']

    return allowedTabs.includes(tab)
  }
}
