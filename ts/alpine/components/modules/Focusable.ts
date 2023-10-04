export const DEFAULT_SELECTOR = 'a, button, input:not([type="hidden"]), textarea, select, details, [tabindex]:not([tabindex="-1"]), [contenteditable]'

export default class Focusable {
  readonly element: HTMLElement

  readonly selector: string

  constructor (element: HTMLElement, selector: string = DEFAULT_SELECTOR) {
    this.element = element
    this.selector = selector
  }

  getFocusables (): HTMLElement[] {
    return <HTMLElement[]> Array
      .from(this.element.querySelectorAll(this.selector))
      .filter(el => !el.hasAttribute('disabled') && !el.hasAttribute('hidden'))
  }

  getFirstFocusable (): HTMLElement|undefined {
    return this.getFocusables().shift()
  }

  getLastFocusable (): HTMLElement|undefined {
    return this.getFocusables().pop()
  }

  getNextFocusable (): HTMLElement|undefined {
    return this.getFocusables()[this.getNextFocusableIndex()] || this.getFirstFocusable()
  }

  getPrevFocusable (): HTMLElement|undefined {
    return this.getFocusables()[this.getPrevFocusableIndex()] || this.getLastFocusable()
  }

  getNextFocusableIndex (): number {
    if (document.activeElement instanceof HTMLElement) {
      const index = this.getFocusables().indexOf(document.activeElement) + 1
      const length = this.getFocusables().length + 1

      return index % length
    }

    return 0
  }

  getPrevFocusableIndex (): number {
    if (document.activeElement instanceof HTMLElement) {
      return Math.max(0, this.getFocusables().indexOf(document.activeElement)) - 1
    }

    return 0
  }
}
