import { baseComponent, Component } from '../alpine'
import { computePosition, offset, autoUpdate, flip } from '@floating-ui/dom'

export type PositioningRefs = {
  popover: HTMLElement
}

export interface Positioning extends Component {
  popover: boolean
  $refs: PositioningRefs
  cleanupPosition: CallableFunction | null
  initPositioningSystem (): void
  syncPopoverPosition (): void
  open (): void
  close (): void
  toggle (): void
  handleEscape (): void
  updatePosition(): void
}

export const positioning: Positioning = {
  ...baseComponent,
  popover: false,
  $refs: {} as PositioningRefs,
  cleanupPosition: null,
  initPositioningSystem () {
    this.$watch('popover', (state) => {
      if (!state && this.cleanupPosition) {
        this.cleanupPosition()

        this.cleanupPosition = null
      }

      if (window.innerWidth < 640) {
        return this.$refs.popover.removeAttribute('style')
      }

      if (state && !this.cleanupPosition) {
        this.$nextTick(() => this.syncPopoverPosition())
      }
    })
  },
  syncPopoverPosition () {
    this.cleanupPosition = autoUpdate(
      this.$root,
      this.$refs.popover,
      () => this.updatePosition()
    )
  },
  open () { this.popover = true },
  close () { this.popover = false },
  toggle () { this.popover = !this.popover },
  handleEscape () { this.close() },
  updatePosition () {
    computePosition(this.$root, this.$refs.popover, {
      placement: 'bottom',
      middleware: [
        offset(4),
        flip()
      ]
    }).then(({ x, y }) => {
      return Object.assign(this.$refs.popover.style, {
        position: 'absolute',
        left: `${x}px`,
        top: `${y}px`
      })
    })
  }
}
