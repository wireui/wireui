import { unMaskCurrency, UnMaskCurrency } from './unMaskCurrency'
import { maskCurrency, MaskCurrency } from './maskCurrency'

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

export interface Currency {
  mask: MaskCurrency
  unMask: UnMaskCurrency
}

export const currency: Currency = {
  mask: maskCurrency,
  unMask: unMaskCurrency
}

export default currency
