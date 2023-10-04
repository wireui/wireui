import { autoUpdate, computePosition, flip, offset } from '@floating-ui/dom'
import { Ref, ref, UnwrapRef, watch } from 'vue'

export default class Positioning {
  private state: Ref<UnwrapRef<boolean>> = ref(false)

  private cleanupPosition: CallableFunction | null = null

  private readonly root: HTMLElement

  private readonly popover: HTMLElement

  constructor (root: HTMLElement, popover: HTMLElement) {
    this.root = root
    this.popover = popover
  }

  start (): this {
    watch(this.state, () => {
      if (!this.state && this.cleanupPosition) {
        this.cleanupPosition()

        this.cleanupPosition = null
      }

      if (window.innerWidth < 640) {
        return this.popover.removeAttribute('style')
      }

      if (this.state && !this.cleanupPosition) {
        queueMicrotask(() => this.syncPopoverPosition())
      }
    })

    return this
  }

  watch (callback: CallableFunction): this {
    watch(this.state, (value, oldValue) => callback(value, oldValue))

    return this
  }

  private syncPopoverPosition (): void {
    this.cleanupPosition = autoUpdate(
      this.root,
      this.popover,
      () => this.updatePosition(),
      { animationFrame: true }
    )
  }

  private updatePosition (): void {
    computePosition(this.root, this.popover, {
      placement: 'bottom',
      middleware: [
        offset(4),
        flip()
      ]
    }).then(({ x, y }) => {
      return Object.assign(this.popover.style, {
        position: 'absolute',
        left: `${x}px`,
        top: `${y}px`
      })
    }) 
  }

  open (): void {
    this.state.value = true
  }

  close (): void {
    this.state.value = false
  }

  toggle (): void {
    this.state.value = !this.state.value
  }

  closeIfNotFocused (): void {
    if (!this.root.contains(document.activeElement) && this.state) {
      this.close()
    }
  }

  handleEscape (): void {
    this.close()
  }
}
