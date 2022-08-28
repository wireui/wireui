import Alpine from 'alpinejs'
import { Alpine as AlpineInterface, baseComponent, Component } from '@/components/alpine'

export interface MockedAlpine extends AlpineInterface {
  store (name: string, data?: any): any
}

export const sleep = (ms: number) => {
  return new Promise(resolve => setTimeout(resolve, ms))
}

export const mockAlpineComponent = (component: Component): Component => {
  component = Object.assign(component, {
    $watch: jest.fn(),
    $cleanup: jest.fn(baseComponent.$cleanup)
  })

  if (component.init) {
    component.init()
  }

  return component
}

export const AlpineMock: MockedAlpine = {
  raw: jest.fn(Alpine.raw),
  data: jest.fn(Alpine.data),
  store: jest.fn(Alpine.store),
  magic: jest.fn(Alpine.magic),
  evaluate: jest.fn(Alpine.evaluate),
  directive: jest.fn(Alpine.directive)
}
