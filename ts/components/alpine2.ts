import { $Wire } from '@/livewire'

export abstract class AlpineComponent {
  $wire!: $Wire
  $el!: HTMLElement
  $root!: HTMLElement
  $refs!: { [name: string]: HTMLElement }
  $nextTick!: (callback: CallableFunction) => void
  $dispatch!: (name: string, value: any) => void
  $watch!: (name: string, callback: CallableFunction) => void
  $props!: any

  init?(): void
}
