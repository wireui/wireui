import { Entangle } from '../alpine'
import currency from '../../utils/currency'
import { occurrenceCount } from '../../utils/helpers'

export interface Options {
  model: Entangle
  emitFormatted: boolean
  isLazy: boolean
  thousands: string
  decimal: string
  precision: number
}

export interface Config {
  emitFormatted: boolean
  isLazy: boolean
  thousands: string
  decimal: string
  precision: number
}

export interface Currency {
  [index: string]: any

  model: Entangle
  input: string | null
  config: Config

  init (): void
  mask (value: any, emitInput?: boolean): void
  unMask (value: any): number | null
  emitInput (value: any): void
}

export default (options: Options): Currency => ({
  model: options.model,
  input: null,
  config: {
    emitFormatted: options.emitFormatted,
    isLazy: options.isLazy,
    thousands: options.thousands,
    decimal: options.decimal,
    precision: options.precision
  },

  init () {
    if (typeof this.model !== 'object') {
      this.mask(this.model)
    }

    this.$watch('model', value => {
      if (!this.config.emitFormatted) {
        value = currency.mask(value, this.config)
      }

      if (value !== this.input) {
        this.mask(value, false)
      }
    })
  },
  mask (value, emitInput = true) {
    if (typeof value === 'number') {
      value = value.toFixed(this.config.precision).toString().replace('.', this.config.decimal)
    }

    if (value?.endsWith(this.config.decimal) && occurrenceCount(value, this.config.decimal) === 1) {
      if (value.length === 1) {
        this.input = `0${this.config.decimal}`

        return
      }

      return
    }

    this.input = currency.mask(value, this.config)

    if (!this.config.isLazy && emitInput) {
      this.emitInput(this.input)
    }
  },
  unMask (value) {
    return currency.unMask(value, this.config)
  },
  emitInput (value) {
    this.model = this.config.emitFormatted
      ? value
      : this.unMask(value)
  }
})
