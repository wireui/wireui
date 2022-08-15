import { ColorsStore } from '@/alpine/store/colorPicker'
import { ModalStore } from '@/alpine/store/modal'

export type Entangle = any

export type WireModifiers = {
  defer: boolean
  lazy: boolean
  debounce: {
    exists: boolean
    delay: number
  },
}

export interface DirectiveUtilities {
  // eslint-disable-next-line no-use-before-define
  Alpine: Alpine
  effect: () => void
  cleanup: (callback: CallableFunction) => void
  evaluate: (expression: string) => unknown
  evaluateLater: (expression: string) => (result: unknown) => void
}

export interface DirectiveParameters {
  value: string
  modifiers: string[]
  expression: string
  original: string
  type: string
}

export interface Alpine {
  raw (data: any): any
  data (name: string, data: any): void
  store (name: 'wireui:color-picker', data?: ColorsStore): ColorsStore
  store (name: 'wireui:modal', data?: ModalStore): ModalStore
  evaluate (scope: any, expression: string): any
  magic (name: string, callback: (el: HTMLElement) => any): void
  directive(
    name: string,
    handler: (el: Node, directive: DirectiveParameters, utilities: DirectiveUtilities) => void,
  ): void;
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
