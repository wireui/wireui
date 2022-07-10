import { ModalStore } from '@/alpine/store/modal'
import { Component, Entangle } from '@/components/alpine'
import { focusables, Focusables } from '@/components/modules/focusables'
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
}

export default (options: Options): Modal => ({
  ...focusables,
  focusableSelector: 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])',
  show: options.model || options.show,
  id: uuid(),
  store: window.Alpine.store('wireui:modal'),

  init () {
    this.$watch('show', value => {
      this.$el.dispatchEvent(new Event(value ? 'open' : 'close'))
    })
  },
  close () {
    this.show = false
    this.toggleScroll()
    this.store.remove(this.id)
  },
  open () {
    this.show = true
    this.store.setCurrent(this.id)
    this.toggleScroll()
  },
  toggleScroll () {
    if (!this.store.isCurrent(this.id)) return

    const elements = [...document.querySelectorAll('body, [main-container]')]

    this.show
      ? elements.forEach(el => el.classList.add('!overflow-hidden'))
      : elements.forEach(el => el.classList.remove('!overflow-hidden'))
  }
})
