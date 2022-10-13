import { CurrencyConfig } from './index'

export interface UnMaskCurrency {
  (value: string | null, config: CurrencyConfig): number | null
}

export const unMaskCurrency: UnMaskCurrency = (value, config): number | null => {
  if (!value) return null

  const currency = parseFloat(
    value.replaceAll(config.thousands, '').replace(config.decimal, '.')
  )

  const isNegative = value.startsWith('-')

  return isNegative ? -Math.abs(currency) : Math.abs(currency)
}
