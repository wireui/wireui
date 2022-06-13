import colorPicker, { ColorPicker, InitOptions } from '@/components/color-picker'
import { mockAlpineComponent } from '@tests/helpers'

describe('Testing the color picker component', () => {
  function mockComponent (initOptions: InitOptions = {}): ColorPicker {
    const component = colorPicker(initOptions)
    component.$refs = { input: document.createElement('input') }

    return mockAlpineComponent(component) as ColorPicker
  }

  it('should open the dropdown', () => {
    const component = mockComponent()

    expect(component.state).toBeFalse()

    component.open()

    expect(component.state).toBeTrue()
  })

  it('should close the dropdown', () => {
    const component = mockComponent()

    component.open()

    expect(component.state).toBeTrue()

    component.close()

    expect(component.state).toBeFalse()
  })

  it('should toggle the dropdown', () => {
    const component = mockComponent()

    component.toggle()

    expect(component.state).toBeTrue()

    component.toggle()

    expect(component.state).toBeFalse()
  })

  it('should select a color and close the dropdown', () => {
    const color = '#FFFFFF'
    const component = mockComponent()

    expect(component.selected).toBeNull()

    component.select(color)

    expect(component.selected).toBe(color)
    expect(component.state).toBeFalse()
  })

  it('should mask the value before selecting a color', () => {
    const component = mockComponent()

    component.setColor('#000000ABCDEFG')

    expect(component.selected).toBe('#000000')
  })

  it('should fill the color from input element value', () => {
    let component = colorPicker()
    component.$refs = { input: document.createElement('input') }
    component.$refs.input.value = '#000'
    component = mockAlpineComponent(component) as ColorPicker

    expect(component.state).toBeFalse()
    expect(component.selected).toBe('#000')
  })

  it('should fill the selected color from wire model value', () => {
    const color = '#FFFFFF'
    const component = mockComponent({ wireModel: color })

    expect(component.selected).toBe(color)
  })

  it('should init the livewire watchers when the wire model is given', () => {
    const component = mockComponent({ wireModel: '#FFF' })

    expect(component.$watch).toBeCalledTimes(2)
    expect(component.$watch).toBeCalledWith('selected', expect.any(Function))
    expect(component.$watch).toBeCalledWith('wireModel', expect.any(Function))
  })

  test('ensure that the livewire watches is not created when dont have a wire model', () => {
    const component = mockComponent()

    expect(component.$watch).toBeCalledTimes(0)
  })

  it('should show colors from a custom provider', () => {
    const colors = [{ name: 'AAA', value: '#AAA' }]
    const component = mockComponent({ colors })

    expect(component.colors).toBe(colors)
  })
})
