import { ColorsStore } from '@/alpine/store/colorPicker'
import { ModalStore } from '@/alpine/store/modal'

export type Entangle = any

export type ModelModifiers = {
  blur: boolean
  debounce: {
    exists: boolean
    delay: number
  },
  throttle: {
    exists: boolean
    delay: number
  }
}

export type WireModifiers = ModelModifiers & {
  live: boolean
}

export interface WireModel {
  exists: boolean
  livewireId: string
  name: string
  modifiers: WireModifiers
}

export interface AlpineModel {
  exists: boolean
  name: string
  modifiers: ModelModifiers
}

export interface DirectiveUtilities {
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

export type MagicAlpineHelpers = {
  Alpine: Alpine
  evaluate: (el: Element, expression: string, extras?: any) => any
}

export interface Alpine {
  raw (data: any): any
  $data (el: HTMLElement): any
  data (name: string, data: any): void
  store (name: 'wireui:color-picker', data?: ColorsStore): ColorsStore
  store (name: 'wireui:modal', data?: ModalStore): ModalStore
  evaluate (scope: any, expression: string): any
  magic (name: string, callback: (el: HTMLElement) => any): void
  directive(
    name: string,
    handler: (el: Node, directive: DirectiveParameters, utilities: DirectiveUtilities) => void,
  ): void;
  effect(callback: () => void): void
}

export interface Component {
  $wire: any
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
