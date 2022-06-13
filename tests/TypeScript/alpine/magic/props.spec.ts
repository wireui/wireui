import { props, watchProps } from '@/alpine/magic/props'
import { Component } from '@/components/alpine'
import { AlpineMock, mockAlpineComponent, sleep } from '@tests/helpers'

describe('Testing the props magic helper', () => {
  beforeEach(() => {
    window.Alpine = AlpineMock
  })

  it('should get the props from the x-props attribute', () => {
    const $root = document.createElement('div')
    const el = document.createElement('div')

    $root.setAttribute('x-data', '{}')
    $root.setAttribute('x-props', '{ foo: "bar" }')
    $root.appendChild(el)

    expect(props(el)).toEqual({ foo: 'bar' })
    expect(window.Alpine.evaluate).toHaveBeenNthCalledWith(1, el, '$root')
    expect(window.Alpine.evaluate).toHaveBeenNthCalledWith(2, $root, '{ foo: "bar" }')
  })

  it('should return an empty object if the attribute is not present or the root parent not exists', () => {
    const el = document.createElement('div')

    expect(props(el)).toEqual({})
    expect(window.Alpine.evaluate).toHaveBeenCalledWith(el, '$root')
    expect(window.Alpine.evaluate).toBeCalledTimes(1)
  })

  it('should run the callback when the props is changed', async () => {
    const $root = document.createElement('div')
    const callback = jest.fn()
    const component = mockAlpineComponent({} as Component)
    component.$root = $root

    $root.setAttribute('x-props', '{ foo: false }')

    watchProps(component, callback)

    $root.setAttribute('x-props', '{ foo: true }')

    await sleep(100)

    expect(callback).toHaveBeenCalled()
  })
})
