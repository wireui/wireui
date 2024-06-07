import { Alpine as AlpineInterface, baseComponent, Component } from '@/components/alpine'
import { AlpineComponent } from '@/components/alpine2'
import { WireUiHooks } from '@/hooks'
import Alpine from 'alpinejs'

export interface MockedAlpine extends AlpineInterface {
  store (name: string, data?: any): any
}

export const sleep = (ms: number) => {
  return new Promise(resolve => setTimeout(resolve, ms))
}

export const mockAlpineComponent = (component: Component|AlpineComponent): Component|AlpineComponent => {
  component = Object.assign(component, {
    $watch: jest.fn(),
    $cleanup: jest.fn(baseComponent.$cleanup)
  })

  if (component.init) {
    component.init()
  }

  return component
}

export const WireuiMock: WireUiHooks = {
  cache: {},
  hook: jest.fn(),
  dispatchHook: jest.fn()
}

export const AlpineMock: MockedAlpine = {
  raw: jest.fn(Alpine.raw),
  $data: jest.fn(Alpine.$data),
  data: jest.fn(Alpine.data),
  store: jest.fn(Alpine.store),
  magic: jest.fn(Alpine.magic),
  evaluate: jest.fn(Alpine.evaluate),
  directive: jest.fn(Alpine.directive),
  effect: jest.fn(Alpine.effect)
}
