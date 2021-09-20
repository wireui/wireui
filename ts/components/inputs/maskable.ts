import { Masker, masker } from '../../utils/masker'
import { Entangle } from '../alpine'

export interface Options {
  model: Entangle
  emitFormatted: boolean
  isLazy: boolean
  mask: string
}

export interface Config {
  emitFormatted: boolean
  isLazy: boolean
  mask: string
}

export interface Maskable {
  [index: string]: any

  model: Entangle
  input: string | null
  masker: Masker
  config: Config

  init (): void
  onInput (value: string | null): void
  emitInput (): void
}

export default (options: Options): Maskable => ({
  model: options.model,
  input: null,
  masker: masker(options.mask, null),
  config: {
    emitFormatted: options.emitFormatted,
    isLazy: options.isLazy,
    mask: options.mask
  },

  init () {
    this.input = this.masker.apply(this.model).value

    this.$watch('model', value => {
      this.input = this.masker.apply(value).value
    })
  },
  onInput (value: string | null) {
    this.input = this.masker.apply(value).value

    if (!this.config.isLazy) {
      this.emitInput()
    }
  },
  emitInput () {
    this.model = this.config.emitFormatted
      ? this.masker.value
      : this.masker.getOriginal()
  }
})
