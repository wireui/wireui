import { AlpineComponent } from '@/components/alpine2'
import { autoUpdate, computePosition, flip, offset, shift } from '@floating-ui/dom'

export interface HasPositionable {
  positionable: Positionable
}

export default class Positionable {
  state: boolean = false

  private cleanupPosition?: CallableFunction = undefined

  declare private component: AlpineComponent

  declare private target: HTMLElement

  declare private popover: HTMLElement

  start (
    component: AlpineComponent,
    target: HTMLElement,
    popover: HTMLElement
  ): this {
    this.component = component
    this.target = target
    this.popover = popover

    this.watch(state => {
      if (!state && this.cleanupPosition) {
        this.cleanupPosition()

        this.cleanupPosition = undefined
      }
    })

    this.watch(state => {
      if (window.innerWidth < 640) {
        return this.popover.removeAttribute('style')
      }

      if (state && !this.cleanupPosition) {
        this.component.$nextTick(() => this.syncPopoverPosition())
      }
    })

    return this
  }

  open (): void {
    this.state = true
  }

  close (): void {
    this.state = false
  }

  toggle (): void {
    this.state = !this.state
  }

  closeIfNotFocused (): void {
    if (!this.target.contains(document.activeElement) && this.state) {
      this.close()
    }
  }

  handleEscape (): void {
    this.close()
  }

  watch (callback: (value: boolean) => void): this {
    queueMicrotask(() => {
      this.component.$watch(
        'positionable.state',
        (value: boolean) => callback(value)
      )
    })

    return this
  }

  private syncPopoverPosition (): void {
    this.cleanupPosition = autoUpdate(
      this.target,
      this.popover,
      () => this.updatePosition(),
      { animationFrame: true }
    )
  }

  private updatePosition (): void {
    computePosition(this.target, this.popover, {
      placement: 'bottom',
      strategy: 'absolute',
      middleware: [
        offset(4),
        flip(),
        shift()
      ]
    }).then(({ x, y }) => {
      if (x >= 10) { x = 0 }
      if (y >= 100) { y = 0 }

      return Object.assign(this.popover.style, {
        position: 'absolute',
        left: `${x}px`,
        top: `${y}px`
      })
    })
  }
}
