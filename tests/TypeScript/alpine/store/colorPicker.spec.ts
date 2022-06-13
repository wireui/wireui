import colorPicker from '@/alpine/store/colorPicker'

describe('Testing the color picker store', () => {
  it('should have the default colors', () => {
    expect(colorPicker.colors).toBeArray()
    expect(colorPicker.colors.length > 0).toBeTrue()
  })

  it('should set the picker colors at runtime', () => {
    colorPicker.setColors([
      { name: 'Black', value: '#000' },
      { name: 'White', value: '#fff' }
    ])

    expect(colorPicker.colors).toBeArray()
    expect(colorPicker.colors.length).toEqual(2)
  })
})
