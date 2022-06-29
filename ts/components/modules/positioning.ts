import { baseComponent, Component } from '../alpine'

export type Position = {
  x: 'left' | 'right'
  y: 'top' | 'bottom'
}

export type Refs = {
  popover: HTMLElement
}

let syncPopoverPosition: any = null

export interface Positioning extends Component {
  $refs: Refs
  position: Position
  watchScroll (): void
  removeWatchScroll (): void
  syncPopoverPosition (): void
}

export const positioning: Positioning = {
  ...baseComponent,
  $refs: {} as Refs,
  position: {
    x: 'right',
    y: 'bottom'
  },
  watchScroll () {
    if (window.innerWidth < 640) return

    syncPopoverPosition = this.syncPopoverPosition.bind(this)
    window.addEventListener('scroll', syncPopoverPosition)
  },
  removeWatchScroll () {
    if (window.innerWidth < 640) return

    window.removeEventListener('scroll', syncPopoverPosition)
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
  }
}
