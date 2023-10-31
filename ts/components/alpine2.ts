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

  protected skipWatchers: { [name: string]: boolean } = {}

  protected destroyCallbacks: CallableFunction[] = []

  init?(): void

  protected $safeWatch (property: string, callback: CallableFunction): void {
    this.$watch(property, value => {
      if (this.skipWatchers[property]) {
        this.skipWatchers[property] = false

        return
      }

      callback(value)
    })
  }

  protected $skipNextWatcher (property: string, callback: CallableFunction): void {
    this.skipWatchers[property] = true

    callback()

    this.$nextTick(() => {
      this.skipWatchers[property] = false
    })
  }

  $destroy (callback: CallableFunction): void {
    this.destroyCallbacks.push(callback)
  }

  destroy (): void {
    this.destroyCallbacks.forEach(callback => callback())
  }
}
