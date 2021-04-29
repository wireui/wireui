import { assert } from 'chai'
import { describe, it } from 'mocha'
import { maskCurrency } from '../../ts/utils/currency/maskCurrency'
import { unMaskCurrency } from '../../ts/utils/currency/unMaskCurrency'
import { defaultConfig } from '../../ts/utils/currency'

describe('Testing Currency Formatter', () => {
  it('should mask currency value', () => {
    const numbers = 123456
    const currency = maskCurrency(numbers, defaultConfig)

    assert.equal('123,456', currency)
  })

  it('should mask zero value', () => {
    const numbers = 0
    const currency = maskCurrency(numbers, defaultConfig)

    assert.equal('0', currency)
  })

  it('should mask negative numbers', () => {
    const numbers = -1234567.89
    const currency = maskCurrency(numbers, defaultConfig)

    assert.equal('-1,234,567.89', currency)
  })

  it('should mask numbers with four decimals', () => {
    const numbers = 1234.4567
    const currency = maskCurrency(numbers, {
      thousands: ',',
      decimal: '.',
      precision: 4
    })

    assert.equal('1,234.4567', currency)
  })

  it('should mask numbers without decimals', () => {
    const numbers = 1234567.55
    const currency = maskCurrency(numbers, {
      thousands: ',',
      decimal: '.',
      precision: 0
    })

    assert.equal('1,234,567', currency)
  })

  it('should can customize mask separators', () => {
    const numbers = '1234567,89'
    const currency = maskCurrency(numbers, {
      thousands: '.',
      decimal: ',',
      precision: 2
    })

    assert.equal('1.234.567,89', currency)
  })

  it('should unmask currency', () => {
    const currency = '1,234,567.89'

    assert.equal('1234567.89', unMaskCurrency(currency, defaultConfig)?.toString())
  })
})
