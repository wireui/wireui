import { Entangle } from './alpine'

export interface Options {
  model: Entangle
}

export interface Modal {
  [index: string]: any

  show: Entangle

  close (): void
  focusables (): Element[]
  firstFocusable (): Element
  lastFocusable (): Element
  nextFocusable (): Element
  previousFocusable (): Element
  nextFocusableIndex (): number
  previousFocusableIndex (): number
}

export default (options: Options): Modal => ({
  show: options.model,

  init () {
    this.$watch('show', value => {
      value
        ? document.body.classList.add('overflow-y-hidden')
        : document.body.classList.remove('overflow-y-hidden')

      this.$el.dispatchEvent(new Event(value ? 'open' : 'close'))
    })
  },
  close () { this.show = false },
  focusables () {
    const selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'

    return [...this.$el.querySelectorAll(selector)].filter(el => !el.hasAttribute('disabled'))
  },
  firstFocusable () { return this.focusables()[0] },
  lastFocusable () { return this.focusables().slice(-1)[0] },
  nextFocusable () { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
  previousFocusable () { return this.focusables()[this.previousFocusableIndex()] || this.lastFocusable() },
  nextFocusableIndex () {
    if (!document.activeElement) return -1

    return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1)
  },
  previousFocusableIndex () {
    if (!document.activeElement) return -1

    return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1
  }
})
