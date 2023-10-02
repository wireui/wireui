import { baseComponent, Component } from '../alpine'

export interface Focusables extends Component {
  focusableSelector: string
  getFocusables (): HTMLElement[]
  getFirstFocusable (): HTMLElement | undefined
  getLastFocusable (): HTMLElement | undefined
  getNextFocusable (): HTMLElement
  getPrevFocusable (): HTMLElement
  getNextFocusableIndex (): number
  getPrevFocusableIndex (): number
}

export const focusables: Focusables = {
  ...baseComponent,
  focusableSelector: '',
  getFocusables () {
    return Array.from(this.$root.querySelectorAll(this.focusableSelector))
      .filter(el => !el.hasAttribute('disabled')) as HTMLElement[]
  },
  getFirstFocusable () { return this.getFocusables().shift() },
  getLastFocusable () { return this.getFocusables().pop() },
  getNextFocusable () { return this.getFocusables()[this.getNextFocusableIndex()] || this.getFirstFocusable() },
  getPrevFocusable () { return this.getFocusables()[this.getPrevFocusableIndex()] || this.getLastFocusable() },
  getNextFocusableIndex () {
    if (document.activeElement instanceof HTMLElement) {
      return (this.getFocusables().indexOf(document.activeElement) + 1) % (this.getFocusables().length + 1)
    }

    return 0
  },
  getPrevFocusableIndex (): number {
    if (document.activeElement instanceof HTMLElement) {
      return Math.max(0, this.getFocusables().indexOf(document.activeElement)) - 1
    }

    return 0
  }
}
