import { MouseSupport } from '@/components/TimeSelector/Draggable/Concerns/MouseSupport'
import { TouchSupport } from '@/components/TimeSelector/Draggable/Concerns/TouchSupport'

type Position = {
  initial: number,
  current: number,
  clientY: number,
}

type EventCallback = (data: Position) => void

export class Draggable {
  public container: HTMLElement

  public position: Position = {
    initial: 0,
    current: 0,
    clientY: 0
  }

  public callbacks = {
    stop: [] as EventCallback[],
    dragging: [] as EventCallback[],
    destroy: [] as CallableFunction[]
  }

  constructor (container: HTMLElement) {
    this.container = container

    new MouseSupport(this)
    new TouchSupport(this)
  }

  reset (data: Position) {
    this.position = data
  }

  destroy (): void {
    this.runCallbacks(this.callbacks.destroy)
  }

  onDragging (callback: EventCallback) {
    this.callbacks.dragging.push(callback)

    return this
  }

  onStop (callback: EventCallback) {
    this.callbacks.stop.push(callback)

    return this
  }

  onDestroy (callback: CallableFunction) {
    this.callbacks.destroy.push(callback)

    return this
  }

  fireStart (data: Position) {
    this.position = data
  }

  fireDragging (data: Position) {
    this.position = data

    this.runCallbacks(this.callbacks.dragging, data)

    return this
  }

  fireStop (data: Position) {
    this.position = data

    this.runCallbacks(this.callbacks.stop, data)

    return this
  }

  fireDestroy () {
    this.runCallbacks(this.callbacks.destroy)

    return this
  }

  private runCallbacks (callbacks: CallableFunction[], data?: Position): void {
    callbacks.forEach(callback => callback(data))
  }
}
