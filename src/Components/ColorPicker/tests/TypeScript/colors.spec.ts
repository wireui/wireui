import { makeColors } from '@components/ColorPicker/ts/colors'

describe('Testing the colors generator', () => {
  it('should generate colors from the tailwind config', () => {
    const colors = makeColors()

    expect(colors).toBeArray()
    expect(colors.every(c => c.name && c.value)).toBeTrue()
  })
})
