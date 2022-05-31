import '@/alpine/store/index'
import colorPicker from '@/alpine/store/colorPicker'

describe('Testing the alpine store', () => {
  window.Alpine = {
    data: jest.fn((name, data) => ({ name, data })),
    store: jest.fn((name, data) => ({ name, data }))
  }

  it('should register all store modules', () => {
    document.dispatchEvent(new Event('alpine:init'))

    expect(window.Alpine.store).toBeCalledTimes(1)
    expect(window.Alpine.store).toBeCalledWith('wireui:color-picker', colorPicker)
  })
})
