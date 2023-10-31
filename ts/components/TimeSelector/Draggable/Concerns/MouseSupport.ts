import { Draggable } from '@/components/TimeSelector/Draggable'

export class MouseSupport {
  constructor (private draggable: Draggable) {
    this.mouseDown = this.mouseDown.bind(this)
    this.mouseMove = this.mouseMove.bind(this)
    this.mouseUp = this.mouseUp.bind(this)

    this.draggable.container.addEventListener('mousedown', this.mouseDown)

    this.draggable.onDestroy(() => {
      this.draggable.container.removeEventListener('mousedown', this.mouseDown)
    })
  }

  private mouseDown (event: MouseEvent): void {
    event.preventDefault()

    this.draggable.fireStart({
      initial: event.clientY,
      clientY: event.clientY,
      current: this.draggable.position.current
    })

    window.addEventListener('mousemove', this.mouseMove)
    window.addEventListener('mouseup', this.mouseUp)

    this.draggable.onStop(() => {
      window.removeEventListener('mousemove', this.mouseMove)
      window.removeEventListener('mouseup', this.mouseUp)
    })
  }

  private mouseMove (event: MouseEvent): void {
    event.preventDefault()

    this.draggable.fireDragging({
      initial: this.draggable.position.initial,
      clientY: event.clientY,
      current: this.makeRelativePosition(event)
    })
  }

  private mouseUp (event: MouseEvent): void {
    event.preventDefault()

    this.draggable.fireStop({
      current: this.makeRelativePosition(event),
      clientY: event.clientY,
      initial: 0
    })
  }

  private makeRelativePosition (event: MouseEvent) {
    return event.clientY - this.draggable.position.initial
  }
}
