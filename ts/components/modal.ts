import uuid from '@/utils/uuid'
import { ModalStore } from '@/alpine/store/modal'
import { AlpineModel, WireModel } from '@/components/alpine'
import toggleScrollbar from '@/utils/scrollbar'
import { AlpineComponent } from '@/components/alpine2'
import { Entangleable, Focusable } from '@/alpine/modules'
import { SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'
import { watchProps } from '@/alpine/magic/props'

const MODAL_FOCUSABLE_SELECTOR = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\']), [contenteditable]'

export default class Modal extends AlpineComponent {
  declare $refs: {
    container: HTMLElement
  }

  declare $props: {
    show: boolean,
    wireModel: WireModel
    alpineModel: AlpineModel
  }

  state = new Entangleable<boolean>()

  focusable = new Focusable()

  id: string = uuid()

  store: ModalStore = window.Alpine.store('wireui:modal')

  init (): void {
    this.focusable.start(this.$refs.container, MODAL_FOCUSABLE_SELECTOR)

    this.$watch('state', state => {
      if (state) {
        this.store.setCurrent(this.id)
        this.toggleScroll()
      } else {
        this.toggleScroll()
        this.store.remove(this.id)
      }

      this.$el.dispatchEvent(new Event(state ? 'open' : 'close'))
    })

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.state, this.$props.wireModel)
    }

    if (this.$props.alpineModel.exists) {
      new SupportsAlpine(this.$root, this.state, this.$props.alpineModel)
    }

    if (this.$props.show) {
      this.state.set(this.$props.show)
    }

    watchProps(this, () => {
      this.$props.show
        ? this.open()
        : this.close()
    })
  }

  close () {
    this.state.set(false)
  }

  open () {
    this.state.set(true)
  }

  toggleScroll () {
    if (!this.store.isFirstest(this.id)) return

    toggleScrollbar(this.state.get() || false)
  }

  handleEscape () {
    if (this.store.isCurrent(this.id)) {
      this.close()
    }
  }

  handleTab (event: KeyboardEvent) {
    if (this.store.isCurrent(this.id) && !event.shiftKey) {
      this.focusable.next().focus()
    }
  }

  handleShiftTab () {
    if (this.store.isCurrent(this.id)) {
      this.focusable.previous().focus()
    }
  }
}
