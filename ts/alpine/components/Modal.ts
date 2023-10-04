import { AlpineComponent } from '@/alpine/components/alpine'
import Entangleable from '@/alpine/entangleable'
import SupportsLivewire from '@/alpine/entangleable/SupportsLivewire'
import { ModalStore } from '@/alpine/store/modal'
import { WireModel } from '@/livewire'
import toggleScrollbar from '@/utils/scrollbar'
import uuid from '@/utils/uuid'

interface Props {
  state: boolean
  id: string
  wireModel: WireModel
}

export default class Modal extends AlpineComponent {
  $props!: Props

  state: Entangleable = new Entangleable().set(false)

  id: string = uuid()

  store: ModalStore = window.Alpine.store('wireui:modal')

  init () {
    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.state, this.$props.wireModel)
    }

    this.id = this.$props.id || uuid()

    this.state.watch((value: boolean) => {
      value
        ? this.store.setCurrent(this.id)
        : this.store.remove(this.id)

      this.toggleScroll()

      this.$el.dispatchEvent(new Event(value ? 'open' : 'close'))
    })

    this.state.set(this.$props.state)
  }

  close () {
    this.state.set(false)
  }

  open () {
    this.state.set(true)
  }

  toggleScroll () {
    if (!this.store.isFirst(this.id)) return

    toggleScrollbar(this.state.get())
  }

  handleEscape () {
    if (this.store.isCurrent(this.id)) {
      this.close()
    }
  }
}
