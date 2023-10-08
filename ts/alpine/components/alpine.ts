import { ColorsStore } from '@/alpine/store/colorPicker'
import { ModalStore } from '@/alpine/store/modal'
import { $Wire } from '@/livewire'

export type Entangle = any

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
  data (name: string, data: any): void
  store (name: 'wireui:color-picker', data?: ColorsStore): ColorsStore
  store (name: 'wireui:modal', data?: ModalStore): ModalStore
  evaluate (scope: any, expression: string): any
  magic (name: string, callback: (el: HTMLElement) => any): void
  directive (
    name: string,
    handler: (el: Node, directive: DirectiveParameters, utilities: DirectiveUtilities) => void,
  ): void;
  // reactive<Type> (data: Type): Type
  // effect (callback: () => void): void
}

export type FocusManager = {
  focus(el: HTMLElement): void;
  focusable(el: HTMLElement): boolean;
  focusables(): HTMLElement[];
  focused(): HTMLElement | null;
  lastFocused(): HTMLElement | null;
  within(el: HTMLElement): FocusManager;
  first(): void;
  last(): void;
  next(): void;
  previous(): void;
  noscroll(): void;
  wrap(): void;
  getFirst(): HTMLElement | null;
  getLast(): HTMLElement | null;
  getNext(): HTMLElement | null;
  getPrevious(): HTMLElement | null;
}

export abstract class AlpineComponent {
  $wire!: $Wire
  $el!: HTMLElement
  $root!: HTMLElement
  $refs!: { [name: string]: HTMLElement }
  $nextTick!: (callback: CallableFunction) => void
  $dispatch!: (name: string, value: any) => void
  $watch!: (name: string, callback: CallableFunction) => void
  $focus!: FocusManager
}

export function convertClassToObject<Type extends AlpineComponent> (component: Type): Type {
  const names = Object.getPrototypeOf(component)

  return Object.getOwnPropertyNames(names)
    .filter((method) => method !== 'constructor')
    .reduce((object: any, method: any) => {
      // @ts-ignore
      object[method] = component[method]

      return object
    }, Object.assign(component))
}
