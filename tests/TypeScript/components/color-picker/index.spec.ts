import colorPicker, { Color, Props } from '@/components/color-picker'
import { AlpineMock, mockAlpineComponent } from '@tests/helpers'
import { makeColors } from '@/components/color-picker/colors'

type ColorPicker = ReturnType<typeof colorPicker>

describe('Testing the color picker component', () => {
  window.Alpine = AlpineMock
  window.Alpine.store = jest.fn().mockReturnValue(makeColors())

  const nullColor: Color = { value: '', name: '' }

  const defaultProps: Props = {
    colorNameAsValue: false,
    wireModel: {
      exists: false,
      livewireId: '',
      name: '',
      modifiers: {
        live: false,
        blur: false,
        debounce: {
          exists: false,
          delay: 250
        },
        throttle: {
          exists: false,
          delay: 250
        }
      }
    },
    colors: []
  }

  function mockComponent (
    props: Props = defaultProps,
    input = document.createElement('input')
  ): ColorPicker {
    const component = colorPicker()

    component.$refs = {
      input,
      popover: document.createElement('div')
    }

    component.$props = props

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

    window.Alpine.store = jest.fn().mockReturnValue({ colors: [color]})

    expect(component.selected).toMatchObject(nullColor)

    component.select(color)

    expect(component.selected).toMatchObject(color)
    expect(component.popover).toBeFalse()
  })

  it('should mask the value before selecting a color', () => {
    const color: Color = { value: '#000000', name: 'Black' }
    const component = mockComponent()

    window.Alpine.store = jest.fn().mockReturnValue([color])

    component.setColor('#000000ABCDEFG')

    expect(component.selected.value).toBe('#000000')
  })

  it('should fill the color from input element value', () => {
    const input = document.createElement('input')
    input.value = '#000'

    const component = mockComponent(defaultProps, input)

    expect(component.popover).toBeFalse()
    expect(component.selected.value).toBe('#000')
  })

  it('should fill the selected color from wire model value', () => {
    const color: Color = { value: '#fff', name: 'White' }

    window.Livewire = {
      find: jest.fn().mockReturnValue({
        watch: jest.fn(),
        get: jest.fn().mockReturnValue(color.value)
      })
    }

    const component = mockComponent({
      ...defaultProps,
      wireModel: {
        ...defaultProps.wireModel,
        name: 'color',
        exists: true,
        livewireId: 'lv-test'
      }
    })

    expect(component.selected.value).toBe(color.value)
  })

  test('ensure that the livewire watches is not created when dont have a wire model', () => {
    const component = mockComponent()

    expect(component.$watch).toBeCalledTimes(1)
    expect(component.$watch).toBeCalledWith('popover', expect.any(Function))
  })

  it('should show colors from a custom provider', () => {
    const colors = [{ name: 'AAA', value: '#AAA' }]
    const component = mockComponent({ ...defaultProps, colors })

    expect(component.colors).toBe(colors)
  })
})
