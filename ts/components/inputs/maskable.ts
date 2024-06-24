import { Masker, masker } from '@/utils/masker'
import { AlpineModel } from '../alpine'
import { WireModel } from '@/livewire'
import { AlpineComponent } from '@/components/alpine2'
import { Entangleable } from '@/alpine/modules'
import { SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'
import { isNotEmpty } from '@/utils/helpers'

export default class Maskable extends AlpineComponent {
  declare $props: {
    emitFormatted: boolean
    mask: string
    wireModel: WireModel
    alpineModel: AlpineModel
  }

  declare $refs: {
    input: HTMLInputElement
    rawInput: HTMLInputElement
  }

  masker: Masker = masker('', null)

  input: string|null = null

  entangleable = new Entangleable<string|null>()

  get value (): string|null {
    return this.$props.emitFormatted
      ? this.masker.value
      : this.masker.getOriginal()
  }

  init () {
    this.masker.mask = this.$props.mask

    this.entangleable.watch(value => {
      this.input = this.$props.emitFormatted
        ? String(value)
        : this.masker.apply(value).value
    })

    this.$watch('input', (value: string|null) => {
      this.masker.apply(value)
      this.input = this.masker.value

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
    let value: string|null = this.input

    if (!this.$props.emitFormatted && value) {
      value = this.masker.getOriginal()
    }

    this.entangleable.set(value, { force: true, triggerBlur: true })
  }

  private fillFromRawInput (): void {
    const value = this.$refs.rawInput.value

    if (isNotEmpty(value)) {
      this.input = value
    }
  }
}
