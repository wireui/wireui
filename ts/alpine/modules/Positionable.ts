import { Component } from '@/components/alpine'
import { AlpineComponent } from '@/components/alpine2'
import toggleScrollbar from '@/utils/scrollbar'
import { autoUpdate, computePosition, flip, hide, offset, Placement, shift } from '@floating-ui/dom'

export type Position = Placement

type Config = {
  mobilePositioning: boolean
  position: Position
  offset: number
  toggleScrollbar: boolean
}

export default class Positionable {
  state: boolean = false

  styles: Partial<CSSStyleDeclaration> = {}

  private config: Config = {
    position: 'bottom',
    offset: 4,
    toggleScrollbar: true,
    mobilePositioning: false
  }

  private cleanupPosition?: CallableFunction = undefined

  declare private component: AlpineComponent|Component

  declare private container: HTMLElement

  declare private target: HTMLElement

  start (
    component: AlpineComponent|Component,
    container: HTMLElement,
    target: HTMLElement
  ): this {
    this.component = component
    this.container = container
    this.target = target

    this.watch(state => {
      if (this.shouldToggleScrollbar()) {
        toggleScrollbar(state)
      }

      if (!state && this.cleanupPosition) {
        this.cleanupPosition()

        this.cleanupPosition = undefined
      }
    })

    this.watch(state => {
      if (state && !this.config.mobilePositioning && window.innerWidth < 640) {
        return this.target.removeAttribute('style')
      }

      if (state && !this.cleanupPosition) {
        this.component.$nextTick(() => this.syncPopoverPosition())
      }
    })

    return this
  }

  position (position: Position): this {
    this.config.position = position

    return this
  }

  offset (offset: number): this {
    this.config.offset = offset

    return this
  }

  open (): void {
    this.state = true
  }

  close (): void {
    this.state = false
  }

  toggle (): void {
    this.state = !this.state
  }

  closeIfNotFocused (): void {
    if (!this.container.contains(document.activeElement) && this.state) {
      this.close()
    }
  }

  handleEscape (): void {
    this.close()
  }

  isOpen () {
    return this.state
  }

  isClosed () {
    return !this.isOpen()
  }

  watch (callback: (value: boolean) => void): this {
    queueMicrotask(() => {
      this.component.$watch(
        'positionable.state',
        (value: boolean) => callback(value)
      )
    })

    return this
  }

  private syncPopoverPosition (): void {
    this.cleanupPosition = autoUpdate(
      this.container,
      this.target,
      () => this.computePosition(),
      { animationFrame: true }
    )
  }

  computePosition (): void {
    computePosition(this.container, this.target, {
      placement: this.config.position,
      strategy: 'absolute',
      middleware: [
        offset(this.config.offset),
        flip({ padding: 5 }),
        shift(),
        hide({ padding: -100 })
      ]
    }).then(({ x, y, middlewareData }) => {
      const { referenceHidden } = middlewareData.hide ?? {}

      if (referenceHidden) {
        this.component.$nextTick(() => this.close())
      }

      this.styles = Object.assign(this.target.style, {
        position: 'absolute',
        left: `${x}px`,
        top: `${y}px`
      })
    })
  }

  mobilePositioning (state: boolean): this {
    this.config.mobilePositioning = state

    return this
  }

  toggleScrollbar (state: boolean): this {
    this.config.toggleScrollbar = state

    return this
  }

  private shouldToggleScrollbar (): boolean {
    return !this.config.mobilePositioning
      && this.config.toggleScrollbar
      && window.innerWidth < 640
  }
}
