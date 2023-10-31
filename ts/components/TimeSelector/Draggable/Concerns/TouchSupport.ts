import { Draggable } from '@/components/TimeSelector/Draggable'

export class TouchSupport {
  constructor (private draggable: Draggable) {
    this.touchStart = this.touchStart.bind(this)
    this.touchMove = this.touchMove.bind(this)
    this.touchEnd = this.touchEnd.bind(this)

    this.draggable.container.addEventListener('touchstart', this.touchStart)

    this.draggable.onDestroy(() => {
      this.draggable.container.removeEventListener('touchstart', this.touchStart)
    })
  }

  private touchStart (event: TouchEvent): void {
    if (event.cancelable) {
      event.preventDefault()
    }

    const touch = this.getTouch(event)
    const clientY = touch?.clientY || 0

    this.draggable.fireStart({
      current: this.draggable.position.current,
      initial: clientY,
      clientY
    })

    window.addEventListener('touchmove', this.touchMove)
    window.addEventListener('touchend', this.touchEnd)
    window.addEventListener('touchcancel', this.touchEnd)

    this.draggable.onStop(() => {
      window.removeEventListener('touchmove', this.touchMove)
      window.removeEventListener('touchend', this.touchEnd)
      window.removeEventListener('touchcancel', this.touchEnd)
    })
  }

  private touchMove (event: TouchEvent): void {
    const touch = this.getTouch(event)
    const clientY = touch?.clientY || 0

    this.draggable.fireDragging({
      current: clientY - this.draggable.position.initial,
      initial: this.draggable.position.initial,
      clientY
    })
  }

  private touchEnd (event: TouchEvent): void {
    const touch = this.getTouch(event)
    const clientY = touch?.clientY || 0

    this.draggable.fireStop({
      current: clientY - this.draggable.position.initial,
      initial: 0,
      clientY
    })

    window.removeEventListener('touchmove', this.touchMove)
    window.removeEventListener('touchend', this.touchEnd)
    window.removeEventListener('touchcancel', this.touchEnd)
  }

  private getTouch (event: TouchEvent): Touch|null {
    return event.changedTouches[0] || event.touches[0] || null
  }
}
