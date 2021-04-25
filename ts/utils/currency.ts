export type CurrencyConfig = {
  thousands: string
  decimal: string
  precision: number
}

export const defaultConfig: CurrencyConfig = {
  thousands: ',',
  decimal: '.',
  precision: 2
}

export interface FormatCurrency {
  (value: string | number | null, config: CurrencyConfig): string
}

export interface UnMaskCurrency {
  (value: string | null, config: CurrencyConfig): number | null
}

export interface Currency {
  mask: FormatCurrency
  unMask: UnMaskCurrency
}

const str = (value): string => {
  return value ? value.toString() : ''
}

const onlyNumbers = (value): string => {
  return str(value).replace(/\D+/g, '')
}

const splitCurrency = (numbers: string | null, config: CurrencyConfig): string[] => {
  if (!numbers) return []

  let [digits = null, decimals = null] = numbers?.split(config.decimal)

  digits = onlyNumbers(digits)
  decimals = onlyNumbers(decimals)

  if (decimals?.length > config.precision && config.precision > 0) {
    digits += decimals.slice(0, decimals.length - config.precision)
    decimals = decimals.slice(-Math.abs(config.precision))
  }

  if (digits) {
    digits = parseInt(digits).toString()
  }

  return [digits, decimals]
}

const applyCurrencyMask = (numbers: string, separator: string): string => {
  return numbers.replace(/\B(?=(\d{3})+(?!\d))/g, separator)
}

export const formatCurrency: FormatCurrency = (value = null, config): string => {
  if (typeof value === 'number') {
    value = value.toString()
  }

  const [digits = null, decimals = null] = splitCurrency(value, config)

  let currency = applyCurrencyMask(str(digits), config.thousands)

  if (value?.startsWith('-')) {
    currency = `-${currency}`
  }

  if (decimals && config.precision > 0) {
    currency = `${currency}${config.decimal}${decimals}`
  }

  return currency
}

export const unMaskCurrency: UnMaskCurrency = (value, config): number | null => {
  if (!value) return null

  const currency = parseFloat(value.replace(new RegExp(`\\${config.thousands}`, 'g'), '').replace(config.decimal, '.'))
  const isNegative = value.startsWith('-')

  return isNegative ? -Math.abs(currency) : Math.abs(currency)
}

export const currency: Currency = {
  mask: formatCurrency,
  unMask: unMaskCurrency
}

export default currency
