import Walk from '@/alpine/modules/Walk'

export class Focusable {
  declare container: HTMLElement

  declare selector: string

  declare walk: Walk

  start (container: HTMLElement, selector: string) {
    this.container = container
    this.selector = selector
    this.walk = new Walk(container, selector)
  }

  elements (): HTMLElement[] {
    return <HTMLElement[]> Array
      .from(this.container.querySelectorAll(this.selector))
      .filter(el => !el.hasAttribute('disabled'))
  }

  first (): HTMLElement | undefined {
    return this.elements().shift()
  }

  last (): HTMLElement | undefined {
    return this.elements().pop()
  }

  next (): HTMLElement {
    return this.elements()[this.nextIndex()] || this.first()
  }

  previous (): HTMLElement {
    return this.elements()[this.previousIndex()] || this.last()
  }

  nextIndex (): number {
    if (document.activeElement instanceof HTMLElement) {
      return (this.elements().indexOf(document.activeElement) + 1) % (this.elements().length + 1)
    }

    return 0
  }

  previousIndex (): number {
    if (document.activeElement instanceof HTMLElement) {
      return Math.max(0, this.elements().indexOf(document.activeElement)) - 1
    }

    return 0
  }
}

export default Focusable
