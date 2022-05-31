export type Entangle = any

export interface Alpine {
  data (name: string, data: any): void
  store (name: string, data?: any): any
}

export interface Component {
  $el: HTMLElement
  $root: HTMLElement
  $watch: (name: string, callback: CallableFunction) => void
  $nextTick: (callback: CallableFunction) => void
  $dispatch: (name: string, value: any) => void
  init?(): void
}

export const baseComponent = {} as Component
