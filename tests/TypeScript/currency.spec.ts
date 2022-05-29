import { maskCurrency } from '@/utils/currency/maskCurrency'
import { unMaskCurrency } from '@/utils/currency/unMaskCurrency'
import { defaultConfig } from '@/utils/currency'

describe('Testing Currency Formatter', () => {
  it('should mask currency value', () => {
    const numbers = 123456
    const currency = maskCurrency(numbers, defaultConfig)

    expect('123,456').toEqual(currency)
  })

  it('should mask currency value with custom decimals separator', () => {
    const numbers = '123456,99'
    const currency = maskCurrency(numbers, {
      decimal: ',',
      thousands: '.',
      precision: 2
    })

    expect('123.456,99').toEqual(currency)
  })

  it('should mask currency value with custom thousands separator', () => {
    const numbers = '123456.99'
    const currency = maskCurrency(numbers, {
      decimal: '.',
      thousands: ';',
      precision: 2
    })

    expect('123;456.99').toEqual(currency)
  })

  it('should mask currency value with custom decimals and thousands separator', () => {
    const numbers = '123456D99'
    const currency = maskCurrency(numbers, {
      decimal: 'D',
      thousands: 'T',
      precision: 2
    })

    expect('123T456D99').toEqual(currency)
  })

  it('should mask zero value', () => {
    const numbers = 0
    const currency = maskCurrency(numbers, defaultConfig)

    expect('0').toEqual(currency)
  })

  it('should mask negative numbers', () => {
    const numbers = -1234567.89
    const currency = maskCurrency(numbers, defaultConfig)

    expect('-1,234,567.89').toEqual(currency)
  })

  it('should mask numbers with four decimals', () => {
    const numbers = 1234.4567
    const currency = maskCurrency(numbers, {
      thousands: ',',
      decimal: '.',
      precision: 4
    })

    expect('1,234.4567').toEqual(currency)
  })

  it('should mask numbers without decimals', () => {
    const numbers = 1234567.55
    const currency = maskCurrency(numbers, {
      thousands: ',',
      decimal: '.',
      precision: 0
    })

    expect('1,234,567').toEqual(currency)
  })

  it('should can customize mask separators', () => {
    const brlConfig = {
      thousands: '.',
      decimal: ',',
      precision: 2
    }
    const numbers = '1234567,89'
    const currency = maskCurrency(numbers, brlConfig)

    expect('1.234.567,89').toEqual(currency)

    const intNumbers = 12.55
    const masked = maskCurrency(intNumbers, brlConfig)
    expect('12,55').toEqual(masked)
  })

  it('should unmask currency', () => {
    const currency = '1,234,567.89'

    expect('1234567.89').toEqual(unMaskCurrency(currency, defaultConfig)?.toString())
  })
})
