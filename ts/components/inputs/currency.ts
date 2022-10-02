import { baseComponent, Component, Entangle } from '../alpine'
import currency from '@/utils/currency'
import { occurrenceCount } from '@/utils/helpers'

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

export interface Currency extends Component {
  model: Entangle
  input: string | null
  config: Config

  init (): void
  mask (value: string | number | null, emitInput?: boolean, walkDecimals?: boolean): void
  unMask (value: string | null): number | null
  emitInput (value: string | null): void
}

export default (options: Options): Currency => ({
  ...baseComponent,
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
      this.input = currency.mask(this.model, this.config, false)
    }

    this.$watch('model', value => {
      if (!this.config.emitFormatted) {
        value = currency.mask(value, this.config, false)
      }

      if (value !== this.input) {
        this.mask(value, false, false)
      }
    })
  },
  mask (value, emitInput = true, walkDecimals = true) {
    if (
      typeof value === 'string'
      && value.endsWith(this.config.decimal)
      && occurrenceCount(value, this.config.decimal) === 1
    ) {
      if (value.length === 1) {
        return (this.input = `0${this.config.decimal}`)
      }

      return
    }

    this.input = currency.mask(value, this.config, walkDecimals)

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
