import { baseComponent, Component, Entangle } from './alpine'
import { focusables, Focusables } from './modules/focusables'

export interface Options {
  model?: Entangle
  show: boolean
}

export interface Modal extends Component, Focusables {
  show: Entangle

  close (): void
  open (): void
}

export default (options: Options): Modal => ({
  ...baseComponent,
  ...focusables,
  focusableSelector: 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])',
  show: options.model || options.show,

  init () {
    this.$watch('show', value => {
      const elements = [...document.querySelectorAll('body, [main-container]')]

      elements.forEach(el => {
        value
          ? el.classList.add('!overflow-hidden')
          : el.classList.remove('!overflow-hidden')
      })

      this.$el.dispatchEvent(new Event(value ? 'open' : 'close'))
    })
  },
  close () { this.show = false },
  open () { this.show = true }
})
