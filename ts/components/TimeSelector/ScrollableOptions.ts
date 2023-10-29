import { Draggable } from '@/components/TimeSelector/Draggable'

export default class ScrollableOptions {
  private container: HTMLElement

  private elements: any[]

  private pagination: any[] = []

  private current: any

  private threshold: number = 0

  private draggable: Draggable

  constructor (
    container: HTMLElement,
    elements: any[],
    current: any,
    threshold: number = 38
  ) {
    this.container = container
    this.elements = elements
    this.current = current
    this.threshold = threshold
    this.draggable = new Draggable(this.container)

    this.container.style.top = '0px'
    this.container.classList.add('relative', 'space-y-1.5')
  }

  start () {
    this.render()

    this.draggable
      .onDragging(({ current }) => {
        this.container.style.top = `${current}px`

        if (Math.abs(current) >= this.threshold) {
          this.container.style.top = '0px'

          const currentIndex = this.pagination.indexOf(this.current)
          let newIndex = current < 0 ? currentIndex + 1 : currentIndex - 1

          if (newIndex < 0) {
            newIndex = this.pagination.length - 1
          }

          if (newIndex >= this.pagination.length) {
            newIndex = 0
          }

          this.current = this.pagination[newIndex]

          this.render()
        }
      })
      .onDragging(({ current, clientY }) => {
        if (Math.abs(current) >= this.threshold) {
          this.draggable.reset({
            initial: clientY,
            current: 0,
            clientY
          })
        }
      })
      .onStop(() => {
        this.container.style.transition = 'all 0.1s ease-in-out'
        this.container.style.top = '0px'

        setTimeout(() => {
          this.container.style.transition = ''
        }, 100)
      })
  }

  render () {
    const SELECTED_CSS = [
      'py-1.5',
      'text-primary-700',
      'font-semibold',
      'text-lg',
      'transition-all',
      'duration-100',
      'ease-in-out'
    ]

    const paddedElements = this.padCurrent(this.elements, this.current)

    this.pagination = paddedElements

    paddedElements.forEach((value, index) => {
      const li = this.container.children[index] || document.createElement('li')

      li.innerHTML = value?.toString()

      if (value !== this.current && li.classList.length) {
        li.classList.remove(...SELECTED_CSS)
      }

      if (value === this.current) {
        li.classList.add(...SELECTED_CSS)
      }

      if (!this.container.children[index]) {
        this.container.appendChild(li)
      }
    })
  }

  padCurrent (elements: any[], current: any): any[] {
    if (elements.length === 2) return elements

    const currentIndex = elements.indexOf(current)

    if (currentIndex === -1) throw new Error('Current value not found in elements array')

    const length = elements.length
    const result: any[] = []

    for (let i = -5; i <= 5; i++) {
      const index = (currentIndex + i + length) % length
      result.push(elements[index])
    }

    return result
  }
}
