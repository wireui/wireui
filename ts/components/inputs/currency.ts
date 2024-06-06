import currency from '@/utils/currency'
import { isNotEmpty, occurrenceCount } from '@/utils/helpers'
import { AlpineComponent } from '@/components/alpine2'
import { Entangleable, SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'
import { WireModel } from '@/livewire'
import { AlpineModel } from '@/components/alpine'

export default class Currency extends AlpineComponent {
  declare $props: {
    emitFormatted: boolean
    thousands: string
    decimal: string
    precision: number
    wireModel: WireModel
    alpineModel: AlpineModel
  }

  declare $refs: {
    input: HTMLInputElement
    rawInput: HTMLInputElement
  }

  input: string|null = null

  entangleable = new Entangleable<string|number|null>()

  get value (): string|number|null {
    return this.$props.emitFormatted
      ? this.input
      : this.unMask(this.input)
  }

  init () {
    this.entangleable.watch(value => {
      this.input = this.$props.emitFormatted
        ? String(value)
        : this.mask(value)
    })

    this.$watch('input', () => {
      this.input = this.mask(this.input)

      this.entangleable.set(this.value)
    })

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    if (this.$props.alpineModel.exists) {
      new SupportsAlpine(this.$refs.input, this.entangleable, this.$props.alpineModel)
    }

    this.fillFromRawInput()
  }

  onBlur (): void {
    let value: string|number|null = this.input

    if (!this.$props.emitFormatted && value) {
      value = this.unMask(value)
    }

    this.entangleable.set(value, { force: true, triggerBlur: true })
  }

  mask (value: string|number|null, walkDecimals = true): string|null {
    if (
      typeof value === 'string'
      && value.endsWith(this.$props.decimal)
      && occurrenceCount(value, this.$props.decimal) === 1
    ) {
      if (value.length === 1) {
        return `0${this.$props.decimal}`
      }

      return value
    }

    return currency.mask(value, this.$props, walkDecimals)
  }

  unMask (value: string|null): number|null {
    return currency.unMask(value, this.$props)
  }

  private fillFromRawInput (): void {
    const value = this.$refs.rawInput.value

    if (isNotEmpty(value)) {
      this.input = value
    }
  }
}
