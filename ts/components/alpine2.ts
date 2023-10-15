import { $Wire } from '@/livewire'

export abstract class AlpineComponent {
  declare $wire: $Wire
  declare $el: HTMLElement
  declare $root: HTMLElement
  declare $refs: { [name: string]: HTMLElement }
  declare $nextTick: (callback: CallableFunction) => void
  declare $dispatch: (name: string, value: any) => void
  declare $watch: (name: string, callback: CallableFunction) => void
  declare $props: any

  destroyCallbacks: CallableFunction[] = []

  init?(): void

  $destroy (callback: CallableFunction): void {
    this.destroyCallbacks.push(callback)
  }

  destroy (): void {
    this.destroyCallbacks.forEach(callback => callback())
  }
}
