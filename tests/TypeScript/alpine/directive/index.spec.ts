import '@/alpine/directive/index'
import tooltip from '@/alpine/directive/tooltip'
import { AlpineMock } from '@tests/helpers'

describe('Testing the index directive register', () => {
  window.Alpine = AlpineMock

  it('should register all directive helpers', () => {
    document.dispatchEvent(new Event('alpine:init'))

    expect(window.Alpine.directive).toBeCalledTimes(1)
    expect(window.Alpine.directive).toBeCalledWith('tooltip', tooltip)
  })
})
