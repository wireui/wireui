import resolveConfig from 'tailwindcss/resolveConfig'
import { Config } from 'tailwindcss'
import tailwindConfig from '@/../tailwind.config.js'
import { Color } from '@/components/color-picker'

const excludeColors = [
  'primary',
  'secondary',
  'positive',
  'negative',
  'warning',
  'info'
]

export const makeColors = (): Color[] => {
  const config = resolveConfig(tailwindConfig as unknown as Config) as Config

  const rawColors = config?.theme?.colors ?? {}

  const colors = Object.entries(rawColors).flatMap(([name, values]) => {
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
