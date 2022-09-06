import { isNull } from 'lodash'
import tippy, { Instance, Placement } from 'tippy.js'

export type Refs = {
  content: HTMLDivElement
  tooltip: HTMLDivElement
}

export interface Tooltip {
  $refs: Refs,
  message: string | null
  placement: string
  arrow: boolean
  animation: string
  theme: string
  trigger: string
  timeout: number | null
  instance: Instance

  init(): void
  dispatch(): void
  toggle(): void
  closeInTime(): void
}

export default (params): Tooltip => ({
  $refs: {} as Refs,
  message: params.message,
  placement: params.placement,
  arrow: params.arrow,
  animation: params.animation,
  theme: params.theme,
  trigger: params.trigger,
  timeout: params.timeout,
  instance: {} as Instance,

  init () {
    const content = this.$refs.content.firstElementChild as Element

    this.instance = tippy(content, {
      content: this.message ?? this.$refs.tooltip.innerHTML,
      allowHTML: true,
      placement: this.placement as Placement,
      arrow: this.arrow,
      animation: this.animation,
      theme: this.theme,
      trigger: this.trigger
    })
  },
  dispatch () {
    isNull(this.timeout) ? this.toggle() : this.closeInTime()
  },
  toggle () {
    this.instance.state.isMounted ? this.instance.hide() : this.instance.show()
  },
  closeInTime () {
    this.instance.show()

    setTimeout(() => { this.instance.hide() }, this.timeout ?? 2000)
  }
})
