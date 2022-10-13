import { onlyNumbers } from '../helpers'
import { CurrencyConfig } from './index'

export interface MaskCurrency {
  (value: string | number | null, config: CurrencyConfig, walkDecimals?: boolean): string | null
}

const applyCurrencyMask = (numbers: string, separator: string): string => {
  return numbers.replace(/\B(?=(\d{3})+(?!\d))/g, separator)
}

const splitCurrency = (numbers: string | null, config: CurrencyConfig): string[] => {
  if (!numbers) return []

  let [digits = null, decimals = null] = numbers?.split(config.decimal) ?? []

  digits = onlyNumbers(digits)
  decimals = onlyNumbers(decimals)

  if (digits) {
    digits = parseInt(digits).toString()
  }

  return [digits, decimals]
}

const joinCurrency = (
  digits: string | null,
  decimals: string | null,
  config: CurrencyConfig,
  walkDecimals = true
): string | null => {
  if (digits && config.precision === 0) {
    return applyCurrencyMask(digits, config.thousands)
  }

  if (!walkDecimals && decimals) {
    decimals = decimals?.slice(0, config.precision)
  }

  if (walkDecimals && decimals && config.precision && decimals?.length > config.precision) {
    digits += decimals.slice(0, decimals.length - config.precision)
    decimals = decimals.slice(-Math.abs(config.precision))
  }

  if (digits) {
    digits = applyCurrencyMask(digits, config.thousands)
  }

  if (!decimals) {
    return digits
  }

  return `${digits}${config.decimal}${decimals}`
}

export const maskCurrency: MaskCurrency = (value = null, config, walkDecimals = true) => {
  if (typeof value === 'number') {
    value = value.toString().replace('.', config.decimal)
  }

  const [digits = null, decimals = null] = splitCurrency(value, config)

  let currency = digits

  if (value?.startsWith('-')) {
    currency = `-${currency}`
  }

  currency = joinCurrency(currency, decimals, config, walkDecimals)

  return currency
}
