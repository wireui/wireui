import { isEmpty } from '@/utils/helpers'
import { Entangleable } from './index'
import { AlpineModel } from '@/components/alpine'
import debounce from '@/utils/debounce'
import throttle from '@/utils/throttle'

export default class SupportsAlpine {
  private toAlpineCallback: CallableFunction|null = null

  private fromAlpineCallback: CallableFunction|null = null

  constructor (
    private target: HTMLElement,
    private entangleable: Entangleable<any>,
    private config: AlpineModel,
    preventInitialFill = false
  ) {
    this.entangleable = entangleable
    this.config = config

    this.init()

    if (!preventInitialFill && isEmpty(this.entangleable.get())) {
      this.fillValueFromAlpine()
    }
  }

  private init () {
    window.Alpine.effect(() => {
      try {
        let value = window.Alpine.$data(this.target)[this.config.name]

        let entangleableValue = this.entangleable.get()

        if (this.toAlpineCallback) {
          entangleableValue = this.toAlpineCallback(entangleableValue)
        }

        if (JSON.stringify(entangleableValue) === JSON.stringify(value)) return

        if (this.fromAlpineCallback) {
          value = this.fromAlpineCallback(value)
        }

        this.entangleable.set(value)
      } catch (e) {
        window.reportError(e)
      }
    })

    this.entangleable.onClear(() => {
      this.set(null)
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
      if (this.toAlpineCallback) {
        value = this.toAlpineCallback(value)
      }

      if (window.Alpine.evaluate(this.target, this.config.name) === value) return

      window.Alpine.$data(this.target)[this.config.name] = value
    } catch (e) {
      window.reportError(e)
    }
  }

  toAlpine (callback: CallableFunction): this {
    this.toAlpineCallback = callback

    return this
  }

  fromAlpine (callback: CallableFunction): this {
    this.fromAlpineCallback = callback

    return this
  }

  fillValueFromAlpine (): void {
    let value = window.Alpine.evaluate(this.target, this.config.name)

    if (this.fromAlpineCallback) {
      value = this.fromAlpineCallback(value)
    }

    if (isEmpty(value)) return

    this.entangleable.set(value)
  }
}
