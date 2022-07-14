import debounce from '@/utils/debounce'
import { applyMask, masker, Masker } from '@/utils/masker'
import { baseComponent, Component, Entangle, WireModifiers } from '@/components/alpine'
import { Positioning, positioning, PositioningRefs } from '@/components/modules/positioning'

export type Color = {
  name: string | null
  value: string | null
}

export type InitOptions = {
  colorNameAsValue: boolean
  wireModifiers?: WireModifiers
  wireModel?: Entangle
  colors?: Color[]
}

export type Refs = PositioningRefs & {
  input: HTMLInputElement
}

export interface ColorPicker extends Component, Positioning {
  $refs: Refs
  selected: Color
  masker: Masker
  wireModel: Entangle

  get colors (): Color[]

  init (): void
  initWireModel (): void
  select: (color: Color) => void
  setColor (value: string | null): void
  emitInput (): void
}

export default (options: InitOptions = { colorNameAsValue: false }): ColorPicker => ({
  ...baseComponent,
  ...positioning,
  $refs: {} as Refs,
  selected: { value: null, name: null },
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

    if (options.wireModel !== undefined) {
      this.initWireModel()
    }
  },
  initWireModel () {
    this.setColor(this.wireModel)
    const emitInput = this.emitInput.bind(this)

    if (options.wireModifiers?.lazy) {
      this.$refs.input.addEventListener('blur', emitInput)
      this.$cleanup(() => this.$refs.input.removeEventListener('blur', emitInput))
    } else if (options.wireModifiers?.debounce?.exists) {
      this.$watch(
        'selected',
        debounce(emitInput, options.wireModifiers.debounce.delay)
      )
    } else {
      this.$watch('selected', debounce(emitInput, 300))
    }

    this.$watch('wireModel', (color: string | null) => this.setColor(color))
  },
  select (color) {
    this.selected = color
    this.emitInput()
    this.close()
  },
  setColor (value) {
    if (!options.colorNameAsValue) {
      value = applyMask('!#XXXXXX', value)
    }

    const color = this.colors.find(c => {
      if (options.colorNameAsValue) return c.name === value

      return applyMask('!#XXXXXX', c.value) === value
    })

    this.selected = {
      value: color?.value ?? value,
      name: color?.name ?? value
    }
  },
  emitInput () {
    if (options.colorNameAsValue) {
      return (this.wireModel = this.selected.name)
    }

    this.wireModel = this.selected.value
  }
})
