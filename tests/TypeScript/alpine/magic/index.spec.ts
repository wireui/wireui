import '@/alpine/magic/index'
import { props } from '@/alpine/magic/props'
import { AlpineMock } from '@tests/helpers'

describe('Testing the index magic register', () => {
  window.Alpine = AlpineMock

  it('should register all magic helpers', () => {
    document.dispatchEvent(new Event('alpine:init'))

    expect(window.Alpine.magic).toBeCalledTimes(1)
    expect(window.Alpine.magic).toBeCalledWith('props', props)
  })
})
