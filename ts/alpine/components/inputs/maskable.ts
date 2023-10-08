import { AlpineComponent } from '@/alpine/components/alpine'
import Entangleable from '@/alpine/entangleable'
import { Masker, masker } from '@/utils/masker'

export interface Props {
  emitFormatted: boolean
  mask: string
}

export default class Maskable extends AlpineComponent {
  $props!: Props

  entangleable: Entangleable = new Entangleable()

  input: string|null = null

  masker!: Masker

  init () {
    this.masker = masker(this.$props.mask, this.input)

    this.entangleable.watch((value: string|null) => {
      this.input = this.masker.apply(value).value
    })

    this.$watch('model', (value: string|null) => {
      this.input = this.masker.apply(value).value

      this.entangleable.set(this.getValue())
    })

    this.input = this.masker.apply(this.input).value
  }

  getValue (): string|null {
    return this.$props.emitFormatted
      ? this.masker.value
      : this.masker.getOriginal()
  }

  onBlur (): void {
    this.entangleable.set(this.getValue(), { triggerBlur: true })
  }
}
