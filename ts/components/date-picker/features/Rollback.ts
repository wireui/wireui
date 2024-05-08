import Feature from '@/components/date-picker/features/Feature'
import FluentDate from '@/utils/date'

export default class Rollback extends Feature {
  selectedRollback: FluentDate|null = null

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
    this.selectedRollback = state && this.component.selected
      ? this.component.selected.clone()
      : null
  }

  rollback (): void {
    if (this.selectedRollback) {
      this.component.selected = this.selectedRollback
    }
  }
}
