import { baseComponent, Component } from '../alpine'

export type Position = {
  x: 'left' | 'right'
  y: 'top' | 'bottom'
}

export type PositioningRefs = {
  popover: HTMLElement
}

export interface Positioning extends Component {
  popover: boolean
  $refs: PositioningRefs
  position: Position
  initPositioningSystem (): void
  toggleEventListener (callback: any): void
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
  position: {
    x: 'right',
    y: 'bottom'
  },
  initPositioningSystem () {
    if (window.innerWidth < 640) return

    const callback = this.syncPopoverPosition.bind(this)

    this.$watch('popover', () => {
      if (window.innerWidth >= 640) {
        this.toggleEventListener(callback)
      }
    })
  },
  toggleEventListener (callback) {
    if (this.popover) {
      window.addEventListener('scroll', callback)

      this.$nextTick(() => this.syncPopoverPosition())
    } else {
      window.removeEventListener('scroll', callback)
    }
  },
  syncPopoverPosition () {
    const rect = this.$root.getBoundingClientRect()
    const { clientHeight, clientWidth } = this.$refs.popover

    const topHeightSpace = window.innerHeight - rect.bottom
    const leftWidthSpace = rect.right

    this.position.y = topHeightSpace <= clientHeight ? 'top' : 'bottom'
    this.position.x = leftWidthSpace >= clientWidth ? 'right' : 'left'
  },
  open () { this.popover = true },
  close () { this.popover = false },
  toggle () { this.popover = !this.popover },
  handleEscape () { this.close() }
}
