import colorPicker, { Color, ColorPicker, InitOptions } from '@/components/color-picker'
import { AlpineMock, mockAlpineComponent } from '@tests/helpers'

describe('Testing the color picker component', () => {
  const nullColor = { value: null, name: null }

  function mockComponent (initOptions: InitOptions = { colorNameAsValue: false }): ColorPicker {
    const component = colorPicker(initOptions)
    component.$refs = {
      input: document.createElement('input'),
      popover: document.createElement('div')
    }

    return mockAlpineComponent(component) as ColorPicker
  }

  it('should open the dropdown', () => {
    const component = mockComponent()

    expect(component.popover).toBeFalse()

    component.open()

    expect(component.popover).toBeTrue()
  })

  it('should close the dropdown', () => {
    const component = mockComponent()

    component.open()

    expect(component.popover).toBeTrue()

    component.close()

    expect(component.popover).toBeFalse()
  })

  it('should toggle the dropdown', () => {
    const component = mockComponent()

    component.toggle()

    expect(component.popover).toBeTrue()

    component.toggle()

    expect(component.popover).toBeFalse()
  })

  it('should select a color and close the dropdown', () => {
    const color: Color = { value: '#FFFFFF', name: 'White' }
    const component = mockComponent()

    window.Alpine = AlpineMock
    window.Alpine.store = jest.fn().mockReturnValue([color])

    expect(component.selected).toMatchObject(nullColor)

    component.select(color)

    expect(component.selected).toMatchObject(color)
    expect(component.popover).toBeFalse()
  })

  it('should mask the value before selecting a color', () => {
    const color: Color = { value: '#000000', name: 'Black' }
    const component = mockComponent()

    window.Alpine = AlpineMock
    window.Alpine.store = jest.fn().mockReturnValue([color])

    component.setColor('#000000ABCDEFG')

    expect(component.selected.value).toBe('#000000')
  })

  it('should fill the color from input element value', () => {
    let component = colorPicker()
    component.$refs = {
      input: document.createElement('input'),
      popover: document.createElement('div')
    }
    component.$refs.input.value = '#000'
    component = mockAlpineComponent(component) as ColorPicker

    expect(component.popover).toBeFalse()
    expect(component.selected.value).toBe('#000')
  })

  it('should fill the selected color from wire model value', () => {
    const color: Color = { value: '#FFFFFF', name: 'White' }
    const component = mockComponent({ wireModel: color.value, colorNameAsValue: false })

    expect(component.selected.value).toBe(color.value)
  })

  it('should init the livewire watchers when the wire model is given', () => {
    const component = mockComponent({ wireModel: '#FFF', colorNameAsValue: false })

    expect(component.$watch).toBeCalledTimes(3)
    expect(component.$watch).toBeCalledWith('selected', expect.any(Function))
    expect(component.$watch).toBeCalledWith('wireModel', expect.any(Function))
    expect(component.$watch).toBeCalledWith('popover', expect.any(Function))
  })

  test('ensure that the livewire watches is not created when dont have a wire model', () => {
    const component = mockComponent()

    expect(component.$watch).toBeCalledTimes(1)
    expect(component.$watch).toBeCalledWith('popover', expect.any(Function))
  })

  it('should show colors from a custom provider', () => {
    const colors = [{ name: 'AAA', value: '#AAA' }]
    const component = mockComponent({ colors, colorNameAsValue: false })

    expect(component.colors).toBe(colors)
  })
})
