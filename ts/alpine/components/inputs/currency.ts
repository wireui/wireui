import { AlpineComponent } from '@/alpine/components/alpine'
import Entangleable from '@/alpine/entangleable'
import SupportsLivewire from '@/alpine/entangleable/SupportsLivewire'
import { WireModel } from '@/livewire'
import currency, { CurrencyConfig } from '@/utils/currency'
import { occurrenceCount } from '@/utils/helpers'

export interface Props {
  wireModel: WireModel
  emitFormatted: boolean
  thousands: string
  decimal: string
  precision: number
}

export default class Currency extends AlpineComponent {
  $props!: Props

  entangleable: Entangleable = new Entangleable()

  input: string|null = null

  get currencyConfig (): CurrencyConfig {
    return {
      thousands: this.$props.thousands,
      decimal: this.$props.decimal,
      precision: this.$props.precision
    }
  }

  init () {
    this.$watch('input', (value: string|null) => {
      if (this.$props.emitFormatted) {
        value = currency.mask(value, this.$props)
      }

      this.input = value

      this.entangleable.set(value)
    })

    this.entangleable.watch((value: string|null) => {
      if (!this.$props.emitFormatted) {
        value = currency.mask(value, this.$props, false)
      }

      this.mask(value, false)
    })

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }
  }

  private mask (value: string|null, walkDecimals: boolean = true): string|null {
    if (
      typeof value === 'string'
      && value.endsWith(this.$props.decimal)
      && occurrenceCount(value, this.$props.decimal) === 1
    ) {
      if (value.length === 1) {
        return `0${this.$props.decimal}`
      }

      return null
    }

    return currency.mask(value, this.currencyConfig, walkDecimals)
  }

  private unMask (value: string|null): number|null {
    return currency.unMask(value, this.currencyConfig)
  }

  private getValue (): string|number|null {
    if (this.$props.emitFormatted) {
      return this.input
    }

    return this.unMask(this.input)
  }

  onBlur (): void {
    this.entangleable.set(this.getValue(), { triggerBlur: true })
  }
}
