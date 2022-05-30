import colorPicker, { ColorPicker } from '@/components/color-picker'
import { mockAlpineComponent } from '@tests/helpers'

describe('Testing the color picker component', () => {

  it('should open the dropdown', () => {
    const component = colorPicker()

    expect(component.state).toBeFalse()

    component.open()

    expect(component.state).toBeTrue()
  })

  it('should close the dropdown', () => {
    const component = colorPicker()

    component.open()

    expect(component.state).toBeTrue()

    component.close()

    expect(component.state).toBeFalse()
  })

  it('should select a color and close the dropdown', () => {
    const color = '#FFFFFF'
    const component = colorPicker()

    expect(component.selected).toBeNull()

    component.select(color)

    expect(component.selected).toBe(color)
    expect(component.state).toBeFalse()
  })

  it('should mask the value before selecting a color', () => {
    const component = colorPicker()

    component.setColor('#000000ABCDEFG')

    expect(component.selected).toBe('#000000')
  })

  it('should fill the selected color from wire model value', () => {
    const color = '#FFFFFF'
    const component = mockAlpineComponent(colorPicker({ wireModel: color })) as ColorPicker

    expect(component.selected).toBe(color)
  })

  it('should init the livewire watchers when the wire model is given', () => {
    const component = mockAlpineComponent(colorPicker({ wireModel: '#FFF' })) as ColorPicker

    expect(component.$watch).toBeCalledTimes(2)
    expect(component.$watch).toBeCalledWith('selected', expect.any(Function))
    expect(component.$watch).toBeCalledWith('wireModel', expect.any(Function))
  })

  test('ensure that the livewire watches is not created when dont have a wire model', () => {
    const component = mockAlpineComponent(colorPicker()) as ColorPicker

    expect(component.$watch).toBeCalledTimes(0)
  })
})
