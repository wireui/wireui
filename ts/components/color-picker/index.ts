import { Entangleable, SupportsLivewire } from '@/alpine/modules/entangleable'
import { Focusable } from '@/alpine/modules/Focusable'
import Positionable from '@/alpine/modules/Positionable'
import { AlpineComponent } from '@/components/alpine2'
import { WireModel } from '@/livewire'
import { applyMask } from '@/utils/masker'

export type Color = {
  name: string
  value: string
}

export default class ColorPicker extends AlpineComponent {
  declare $refs: {
    input: HTMLInputElement
    popover: HTMLElement
    container: HTMLLabelElement
    colorsContainer: HTMLDivElement
  }

  declare $props: {
    colorNameAsValue: boolean
    wireModel: WireModel
    colors: Color[]
  }

  selected: Color = { value: '', name: '' }

  entangleable = new Entangleable<string>()

  positionable = new Positionable()

  focusable = new Focusable()

  get colors (): Color[] {
    if (this.$props?.colors?.length) {
      return this.$props.colors
    }

    return window.Alpine.store('wireui:color-picker')?.colors ?? []
  }

  init () {
    this.positionable
      .start(this, this.$refs.container, this.$refs.popover)
      .position('bottom')

    this.focusable.start(this.$refs.colorsContainer, 'button')

    this.entangleable.watch(() => this.syncSelected())

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    // new SupportsAlpine(this.entangleable, this.$refs.input)
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

    this.positionable?.close()
  }

  setColor (color: string | null) {
    if (!this.$props.colorNameAsValue) {
      color = applyMask('!#XXXXXX', color)
    }

    this.entangleable.set(color)

    this.syncSelected()
  }

  onBlur (color: string | null) {
    this.entangleable.set(color, { force:true, triggerBlur: true })
  }
}
