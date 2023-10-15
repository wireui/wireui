import { Color } from '@/components/color-picker'
import tailwindColors from 'tailwindcss/colors'

const excludeColors = [
  'lightBlue',
  'warmGray',
  'trueGray',
  'coolGray',
  'blueGray'
]

export const makeColors = (): Color[] => {
  excludeColors.forEach(color => delete tailwindColors[color])

  const colors = Object.entries(tailwindColors).flatMap(([name, values]) => {
    if (typeof values === 'string' || excludeColors.includes(name)) {
      return []
    }

    return Object.entries(values as object).map(([tonality, hex]) => ({
      name: `${name}-${tonality}`,
      value: hex
    }))
  })

  colors.push({ name: 'White', value: '#fff' })
  colors.push({ name: 'Black', value: '#000' })

  return colors
}
