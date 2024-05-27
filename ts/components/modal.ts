import { ModalStore } from '@/alpine/store/modal'
import { Component, Entangle } from '@/components/alpine'
import { focusables, Focusables } from '@/components/modules/focusables'
import toggleScrollbar from '@/utils/scrollbar'
import uuid from '@/utils/uuid'

export interface Options {
  model?: Entangle
  show: boolean
}

export interface Modal extends Component, Focusables {
  show: Entangle
  id: string
  store: ModalStore

  init (): void
  close (): void
  open (): void
  toggleScroll (): void
  handleEscape (): void
  handleTab (event: KeyboardEvent): void
  handleShiftTab (): void
}

export default (options: Options): Modal => ({
  ...focusables,
  focusableSelector: 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\']), [contenteditable]',
  show: options.model || options.show,
  id: uuid(),
  store: window.Alpine.store('wireui:modal'),

  init () {
    this.$watch('show', value => {
      if (value) {
        this.store.setCurrent(this.id)
        this.toggleScroll()
      } else {
        this.toggleScroll()
        this.store.remove(this.id)
      }

      this.$el.dispatchEvent(new Event(value ? 'open' : 'close'))
    })

    if (this.show) {
      this.store.setCurrent(this.id)
    }
  },
  close () { this.show = false },
  open () { this.show = true },
  toggleScroll () {
    if (!this.store.isFirstest(this.id)) return

    toggleScrollbar(this.show)
  },
  getFocusables () {
    return Array.from(this.$root.querySelectorAll(this.focusableSelector))
      .filter(el => {
        return !el.hasAttribute('disabled')
          && !el.hasAttribute('hidden')
          && this.$root.isSameNode(el.closest('[wireui-modal]'))
      }) as HTMLElement[]
  },
  handleEscape () {
    if (this.store.isCurrent(this.id)) {
      this.close()
    }
  },
  handleTab (event) {
    if (this.store.isCurrent(this.id) && !event.shiftKey) {
      this.getNextFocusable().focus()
    }
  },
  handleShiftTab () {
    if (this.store.isCurrent(this.id)) {
      this.getPrevFocusable().focus()
    }
  }
})
