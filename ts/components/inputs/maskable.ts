import { Masker, masker } from '@/utils/masker'
import { AlpineModel } from '../alpine'
import { WireModel } from '@/livewire'
import { AlpineComponent } from '@/components/alpine2'
import { Entangleable } from '@/alpine/modules'
import { SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'

export default class Maskable extends AlpineComponent {
  declare $props: {
    emitFormatted: boolean
    mask: string
    wireModel: WireModel
    alpineModel: AlpineModel
  }

  declare masker: Masker

  input: string|null = null

  entangleable = new Entangleable<string|null>()

  get value (): string|null {
    return this.$props.emitFormatted
      ? this.masker.value
      : this.masker.getOriginal()
  }

  init () {
    this.masker = masker(this.$props.mask, null)

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    if (this.$props.alpineModel.exists) {
      new SupportsAlpine(this.$refs.input, this.entangleable, this.$props.alpineModel)
    }

    this.entangleable.watch(value => {
      this.input = this.$props.emitFormatted
        ? String(value)
        : this.masker.apply(value).value
    })

    this.$safeWatch('input', (value: string|null) => {
      this.masker.apply(value)
      this.input = this.masker.value

      this.entangleable.set(this.value)
    })
  }

  onBlur (): void {
    let value: string|null = this.input

    if (!this.$props.emitFormatted && value) {
      value = this.masker.getOriginal()
    }

    this.entangleable.set(value, { force: true, triggerBlur: true })
  }
}
