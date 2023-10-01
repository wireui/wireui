import { applyMask, masker } from '@/utils/masker'
import { baseComponent, WireModel } from '@/components/alpine'
import { positioning, PositioningRefs } from '@/components/modules/positioning'
import { watchProps } from '@/alpine/magic/props'
import Entangleable from '@/alpine/proxy/Entangleable'
import SupportsLivewire from '@/alpine/proxy/SupportsLivewire'

export type Color = {
  name: string
  value: string
}

export type InitOptions = {
  colorNameAsValue: boolean
  wireModel: WireModel
  colors: Color[]
}

export type Props = InitOptions

export type Refs = PositioningRefs & {
  input: HTMLInputElement
}

export default () => ({
  ...baseComponent,
  ...positioning,
  $refs: {} as Refs,
  $props: {} as Props,
  selected: { value: '', name: '' } as Color,
  entangleable: {} as Entangleable,
  masker: masker('!#XXXXXX', null),

  get colors (): Color[] {
    if (this.$props.colors.length) {
      return this.$props.colors
    }

    return window.Alpine.store('wireui:color-picker')?.colors ?? []
  },

  init () {
    this.entangleable = new Entangleable()

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    this.initPositioningSystem()

    watchProps(this, this.syncProps.bind(this))

    if (this.entangleable.value) {
      this.setColor(this.entangleable.value)
    }

    this.entangleable.watch(() => this.syncSelected())
  },
  syncProps (mutations: MutationRecord[] = []) {
    console.log('syncProps', mutations)
  },
  syncSelected () {
    const value = this.entangleable.get()

    const selectedColor = this.colors.find(color => {
      if (this.$props.colorNameAsValue) {
        return color.name === value
      }

      return applyMask('!#XXXXXX', color.value) === value
    })

    this.selected = {
      value: selectedColor?.value ?? value ?? '',
      name: selectedColor?.name ?? value ?? ''
    }
  },
  select (color: Color) {
    this.selected = { ...color }

    const value = this.$props.colorNameAsValue
      ? color.name
      : color.value

    this.entangleable.set(value, { force: true, triggerBlur: true })

    this.close()
  },
  setColor (color: string | null) {
    if (!this.$props.colorNameAsValue) {
      color = applyMask('!#XXXXXX', color)
    }

    this.entangleable.set(color)

    this.syncSelected()
  },
  onBlur (color: string | null) {
    this.entangleable.onBlur(color)
  }
})
