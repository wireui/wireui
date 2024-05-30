import ColorPicker, { Color } from '@/components/color-picker'
import { makeColors } from '@/components/color-picker/colors'
import { AlpineMock, mockAlpineComponent } from '@tests/helpers'

describe('Testing the color picker component', () => {
  window.Alpine = AlpineMock
  window.Alpine.store = jest.fn().mockReturnValue(makeColors())

  const nullColor: Color = { value: '', name: '' }

  const defaultProps = {
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
    alpineModel: {
      exists: false,
      name: '',
      modifiers: {
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
    colors: [] as Color[]
  }

  function mockComponent (
    props = defaultProps,
    input = document.createElement('input')
  ): ColorPicker {
    const component = new ColorPicker()

    component.$refs = {
      input,
      popover: document.createElement('div'),
      container: document.createElement('label'),
      colorsContainer: document.createElement('div')
    }

    component.$props = props

    if (input.value) {
      component.setColor(input.value)
    }

    return mockAlpineComponent(component) as ColorPicker
  }

  it('should open the dropdown', () => {
    const component = mockComponent()

    expect(component.positionable.state).toBeFalse()

    component.positionable.open()

    expect(component.positionable.state).toBeTrue()
  })

  it('should close the dropdown', () => {
    const component = mockComponent()

    component.positionable.open()

    expect(component.positionable.state).toBeTrue()

    component.positionable.close()

    expect(component.positionable.state).toBeFalse()
  })

  it('should toggle the dropdown', () => {
    const component = mockComponent()

    component.positionable.toggle()

    expect(component.positionable.state).toBeTrue()

    component.positionable.toggle()

    expect(component.positionable.state).toBeFalse()
  })

  it('should select a color and close the dropdown', () => {
    const color: Color = { value: '#FFFFFF', name: 'White' }
    const component = mockComponent()

    window.Alpine.store = jest.fn().mockReturnValue({ colors: [color]})

    expect(component.selected).toMatchObject(nullColor)

    component.select(color)

    expect(component.selected).toMatchObject(color)
    expect(component.positionable.state).toBeFalse()
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

    expect(component.positionable.state).toBeFalse()
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

    queueMicrotask(() => {
      expect(component.$watch).toBeCalledTimes(2)
      expect(component.$watch).toHaveBeenNthCalledWith(1, 'positionable.state', expect.any(Function))
      expect(component.$watch).toHaveBeenNthCalledWith(2, 'positionable.state', expect.any(Function))
    })
  })

  it('should show colors from a custom provider', () => {
    const colors = [{ name: 'AAA', value: '#AAA' }]
    const component = mockComponent({ ...defaultProps, colors })

    expect(component.colors).toBe(colors)
  })
})
