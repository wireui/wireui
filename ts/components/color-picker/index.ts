import { masker, Masker } from '@/utils/masker'
import { baseComponent, Component, Entangle } from '../alpine'

export type Color = {
  name: string
  value: string
}

export type InitOptions = {
  wireModel?: Entangle
  colors?: Color[]
}

type Refs = {
  input: HTMLInputElement
}

export interface ColorPicker extends Component {
  $refs: Refs
  state: boolean
  selected: string | null
  masker: Masker
  wireModel: Entangle

  get colors (): Color[]

  init (): void

  open: () => void
  close: () => void
  select: (color: string) => void
  setColor (value: string | null): void
}

export default (options: InitOptions = {}): ColorPicker => ({
  ...baseComponent,
  $refs: {} as Refs,
  state: false,
  selected: null,
  masker: masker('!#XXXXXX', null),
  wireModel: options.wireModel ?? null,

  get colors (): Color[] {
    if (options.colors) return options.colors

    return window.Alpine.store('wireui:color-picker')?.colors ?? []
  },

  init () {
    if (this.$refs.input.value) {
      this.setColor(this.$refs.input.value)
    }

    if (options.wireModel) {
      this.selected = this.wireModel

      this.$watch('selected', (color: string | null) => (this.wireModel = color))
      this.$watch('wireModel', (color: string | null) => this.setColor(color))
    }
  },
  open () { this.state = true },
  close () { this.state = false },
  select (color) {
    this.selected = color
    this.close()
  },
  setColor (color) {
    this.selected = this.masker.apply(color).value
  }
})
