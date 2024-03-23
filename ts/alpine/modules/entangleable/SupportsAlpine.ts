import { isEmpty } from '@/utils/helpers'
import { Entangleable } from './index'
import { AlpineModel } from '@/components/alpine'
import debounce from '@/utils/debounce'
import throttle from '@/utils/throttle'

export default class SupportsAlpine {
  constructor (
    private target: HTMLElement,
    private entangleable: Entangleable,
    private config: AlpineModel,
  ) {
    this.entangleable = entangleable
    this.config = config

    this.init()

    if (isEmpty(this.entangleable.get())) {
      this.fillValueFromAlpine()
    }
  }

  private init () {
    window.Alpine.effect(() => {
      try {
        const value = window.Alpine.$data(this.target)[this.config.name]

        this.entangleable.set(value)
      } catch (e) {
        window.reportError(e)
        console.error(e)
      }
    })

    const modifiers = this.config.modifiers

    const hasModifiers = modifiers.blur || modifiers.debounce.exists || modifiers.throttle.exists

    if (!hasModifiers) {
      this.entangleable.watch((value: any) => {
        this.set(value)
      })
    }

    if (modifiers.blur) {
      this.entangleable.onBlur((value: any) => this.set(value))
    }

    if (modifiers.debounce.exists) {
      this.entangleable.watch(debounce(
        (value: any) => this.set(value),
        modifiers.debounce.delay,
      ))
    }

    if (modifiers.throttle.exists) {
      this.entangleable.watch(throttle(
        (value: any) => this.set(value),
        modifiers.throttle.delay,
      ))
    }
  }

  set (value: any) {
    try {
      if (window.Alpine.evaluate(this.target, this.config.name) === value) return

      window.Alpine.$data(this.target)[this.config.name] = value
    } catch (e) {
      window.reportError(e)
      console.error(e)
    }
  }

  private fillValueFromAlpine (): void {
    const value = window.Alpine.evaluate(this.target, this.config.name)

    if (isEmpty(value)) return

    this.entangleable.set(value)
  }
}
