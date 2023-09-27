import { applyMask, masker } from '@/utils/masker'
import { baseComponent, WireModel } from '@/components/alpine'
import { positioning, PositioningRefs } from '@/components/modules/positioning'
import makeEntangleable from '@/alpine/proxies/entangleable.js'

export type Color = {
  name: string
  value: string
}

export type InitOptions = {
  colorNameAsValue: boolean
  wireModel: WireModel
  colors: Color[]
  value: string|null
}

export type Refs = PositioningRefs & {
  input: HTMLInputElement
}

export default (options: InitOptions) => ({
  ...baseComponent,
  ...positioning,
  $refs: {} as Refs,
  selected: { value: '', name: '' } as Color,
  value: null,
  masker: masker('!#XXXXXX', null),

  get colors (): Color[] {
    if (options.colors) return options.colors

    return window.Alpine.store('wireui:color-picker')?.colors ?? []
  },

  init () {
    this.value = makeEntangleable({
      component: this,
      value: options.value,
      wireModel: options.wireModel
    })

    this.initPositioningSystem()

    if (this.value) {
      this.setColor(this.value)
    }

    // todo: watch value
    // const selectedColor = this.colors.find(color => {
    //   if (options.colorNameAsValue) return color.name === value
    //
    //   return applyMask('!#XXXXXX', color.value) === value
    // })
    //
    // this.selected = {
    //   value: selectedColor?.value ?? value ?? '',
    //   name: selectedColor?.name ?? value ?? ''
    // }
  },
  select (color: Color) {
    this.selected = color
    this.close()
  },
  setColor (value: string|null) {
    if (!options.colorNameAsValue) {
      value = applyMask('!#XXXXXX', value)
    }

    this.value = value
  }
})
