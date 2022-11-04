import { baseComponent, Component } from '../alpine'
import { computePosition, autoPlacement, shift, offset, autoUpdate } from '@floating-ui/dom'

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
      }

      if (window.innerWidth < 640) {
        return this.$refs.popover.removeAttribute('style')
      }

      if (state) {
        this.$nextTick(() => this.syncPopoverPosition())
      }
    })
  },
  syncPopoverPosition () {
    this.cleanupPosition = autoUpdate(this.$root, this.$refs.popover, () => {
      computePosition(this.$root, this.$refs.popover, {
        placement: 'bottom',
        middleware: [
          autoPlacement({
            autoAlignment: true,
            allowedPlacements: ['top', 'top-end', 'top-start', 'bottom', 'bottom-end', 'bottom-start'],
            padding: 5
          }),
          offset(3),
          shift()
        ]
      }).then(({ x, y }) => {
        return Object.assign(this.$refs.popover.style, {
          position: 'absolute',
          left: `${x}px`,
          top: `${y}px`
        })
      })
    })
  },
  open () { this.popover = true },
  close () { this.popover = false },
  toggle () { this.popover = !this.popover },
  handleEscape () { this.close() }
}
