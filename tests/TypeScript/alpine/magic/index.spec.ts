import '@/alpine/magic/index'
import props from '@/alpine/magic/props'
import tooltip from '@/alpine/magic/tooltip'
import { AlpineMock } from '@tests/helpers'

describe('Testing the index magic register', () => {
  window.Alpine = AlpineMock

  it('should register all magic helpers', () => {
    document.dispatchEvent(new Event('alpine:init'))

    expect(window.Alpine.magic).toBeCalledTimes(2)
    expect(window.Alpine.magic).toBeCalledWith('props', props)
    expect(window.Alpine.magic).toBeCalledWith('tooltip', tooltip)
  })
})
