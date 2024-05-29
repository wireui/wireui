import Feature from '@/components/date-picker/features/Feature'
import FluentDate from '@/utils/date'

export default class Rollback extends Feature {
  selectedRollback: FluentDate|FluentDate[]|null = null

  init (): void {
    const watchPopover = this.watchPopover.bind(this)
    const rollback = this.rollback.bind(this)

    this.$events.on('popover', watchPopover)
    this.$events.on('cancel', rollback)

    this.component.$destroy(() => {
      this.$events.off('popover', watchPopover)
      this.$events.off('cancel', rollback)
    })
  }

  private watchPopover (state: boolean): void {
    if (this.component.$props.calendar.multiple.enabled) {
      this.selectedRollback = state && this.component.selectedDates.length
        ? this.component.selectedDates?.map(date => date.clone()) ?? []
        : []

      return
    }

    this.selectedRollback = state && this.component.entangleable.isNotEmpty()
      ? this.component.selected?.clone() ?? null
      : null
  }

  rollback (): void {
    if (this.selectedRollback) {
      this.component.entangleable.set(this.selectedRollback, { force: true })
    }
  }
}
