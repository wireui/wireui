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

    this.$watch('popover', popover => {
      if (popover) {
        window.addEventListener('scroll', callback)

        this.$nextTick(() => this.syncPopoverPosition())
      } else {
        window.removeEventListener('scroll', callback)
      }
    })
  },
  syncPopoverPosition () {
    if (window.innerWidth < 640) return

    const rect = this.$root.getBoundingClientRect()
    const popover = this.$refs.popover

    const height = {
      before: rect.top,
      after: window.innerHeight - rect.bottom
    }

    const width = {
      before: rect.left,
      after: window.innerWidth - rect.right - rect.width
    }

    this.position.y = height.after < popover.clientHeight ? 'top' : 'bottom'
    this.position.x = width.after < popover.clientWidth ? 'right' : 'left'
  },
  open () { this.popover = true },
  close () { this.popover = false },
  toggle () { this.popover = !this.popover },
  handleEscape () { this.close() }
}
