import { Component } from '@/components/alpine'

export const sleep = (ms: number) => {
  return new Promise(resolve => setTimeout(resolve, ms))
}

export const mockAlpineComponent = (component: Component): Component => {
  component = Object.assign(component, {
    $watch: jest.fn()
  })

  if (component.init) {
    component.init()
  }

  return component
}
