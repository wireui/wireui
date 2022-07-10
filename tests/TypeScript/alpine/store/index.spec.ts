import '@/alpine/store/index'
import colorPicker from '@/alpine/store/colorPicker'
import modal from '@/alpine/store/modal'
import { AlpineMock } from '@tests/helpers'

describe('Testing the alpine store', () => {
  window.Alpine = AlpineMock

  it('should register all store modules', () => {
    document.dispatchEvent(new Event('alpine:init'))

    expect(window.Alpine.store).toBeCalledTimes(2)
    expect(window.Alpine.store).toBeCalledWith('wireui:color-picker', colorPicker)
    expect(window.Alpine.store).toBeCalledWith('wireui:modal', modal)
  })
})
