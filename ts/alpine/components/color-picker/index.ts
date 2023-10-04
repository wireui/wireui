import { AlpineComponent } from '@/alpine/components/alpine'
import Positioning from '@/alpine/components/modules/Positioning'
import Entangleable from '@/alpine/entangleable'
import SupportsLivewire from '@/alpine/entangleable/SupportsLivewire'
import { WireModel } from '@/livewire'
import { applyMask } from '@/utils/masker'

export type Color = {
  name: string
  value: string
}

export type Props = {
  colorNameAsValue: boolean
  wireModel: WireModel
  colors: Color[]
}

export type Refs = {
  input: HTMLInputElement
  popover: HTMLElement
}

export default class ColorPicker extends AlpineComponent {
  declare $refs: Refs

  $props!: Props

  selected: Color = { value: '', name: '' }

  entangleable: Entangleable = new Entangleable()

  positioning!: Positioning

  constructor () {
    super()
  }

  get colors (): Color[] {
    if (this.$props.colors.length) {
      return this.$props.colors
    }

    return window.Alpine.store('wireui:color-picker')?.colors ?? []
  }

  init () {
    this.positioning = new Positioning(this.$refs.input, this.$refs.popover)

    this.positioning.start()

    this.entangleable.watch(() => this.syncSelected())

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    if (this.$refs.input.value) {
      this.setColor(this.$refs.input.value)
    }
  }

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
  }

  select (color: Color) {
    this.selected = { ...color }

    const value = this.$props.colorNameAsValue
      ? color.name
      : color.value

    this.entangleable.set(value, { force: true, triggerBlur: true })

    this.positioning.close()
  }

  setColor (color: string | null) {
    if (!this.$props.colorNameAsValue) {
      color = applyMask('!#XXXXXX', color)
    }

    this.entangleable.set(color)

    this.syncSelected()
  }

  onBlur (color: string | null) {
    this.entangleable.set(color, { triggerBlur: true })
  }
}
