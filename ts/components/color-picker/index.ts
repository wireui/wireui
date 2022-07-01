import { masker, Masker } from '@/utils/masker'
import { baseComponent, Component, Entangle } from '@/components/alpine'
import { Positioning, positioning, PositioningRefs } from '@/components/modules/positioning'

export type Color = {
  name: string
  value: string
}

export type InitOptions = {
  wireModel?: Entangle
  colors?: Color[]
}

export type Refs = PositioningRefs & {
  input: HTMLInputElement
}

export interface ColorPicker extends Component, Positioning {
  $refs: Refs
  selected: string | null
  masker: Masker
  wireModel: Entangle

  get colors (): Color[]

  init (): void
  select: (color: string) => void
  setColor (value: string | null): void
}

export default (options: InitOptions = {}): ColorPicker => ({
  ...baseComponent,
  ...positioning,
  $refs: {} as Refs,
  selected: null,
  masker: masker('!#XXXXXX', null),
  wireModel: options.wireModel ?? null,

  get colors (): Color[] {
    if (options.colors) return options.colors

    return window.Alpine.store('wireui:color-picker')?.colors ?? []
  },

  init () {
    this.initPositioningSystem()

    if (this.$refs.input.value) {
      this.setColor(this.$refs.input.value)
    }

    if (options.wireModel) {
      this.selected = this.wireModel

      this.$watch('selected', (color: string | null) => (this.wireModel = color))
      this.$watch('wireModel', (color: string | null) => this.setColor(color))
    }
  },
  select (color) {
    this.selected = color
    this.close()
  },
  setColor (color) {
    this.selected = this.masker.apply(color).value
  }
})
