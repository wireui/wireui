import { Entangleable, SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'
import Positionable from '@/alpine/modules/Positionable'
import { AlpineComponent } from '@/components/alpine2'
import { WireModel } from '@/livewire'

export default class TimePicker extends AlpineComponent {
  declare $refs: {
    popover: HTMLElement
    input: HTMLInputElement
    container: HTMLDivElement
    optionsContainer: HTMLDivElement
  }

  declare $props: {
    wireModel: WireModel
    format: string
    displayFormat: string
    readonly: boolean
    disabled: boolean
  }

  entangleable: Entangleable = new Entangleable()

  positionable: Positionable = new Positionable()

  init () {
    this.positionable
      .start(this, this.$refs.container, this.$refs.popover)
      .position('bottom')

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    new SupportsAlpine(this.entangleable, this.$refs.input)
  }
}
