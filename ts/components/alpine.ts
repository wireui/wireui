export type Entangle = any

export interface Alpine {
  raw (data: any): any
  data (name: string, data: any): void
  store (name: string, data?: any): any
  evaluate (scope: any, expression: string): any
  magic (name: string, callback: (el: HTMLElement) => any): void
}

export interface Component {
  $el: HTMLElement
  $root: HTMLElement
  $watch: (name: string, callback: CallableFunction) => void
  $nextTick: (callback: CallableFunction) => void
  $dispatch: (name: string, value: any) => void
  $cleanup: (callback: CallableFunction) => void
  init?(): void
  _x_cleanups?: CallableFunction[]
}

export const baseComponent = {
  $cleanup (callback) {
    if (!this._x_cleanups) this._x_cleanups = []

    this._x_cleanups.push(callback)
  }
} as Component
