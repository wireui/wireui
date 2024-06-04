import { WireModel } from '@/components/alpine'
import debounce from '@/utils/debounce'
import { isEmpty } from '@/utils/helpers'
import throttle from '@/utils/throttle'
import { Entangleable } from './index'

export default class SupportsLivewire {
  private livewire: any

  private toLivewireCallback: CallableFunction|null = null

  private fromLivewireCallback: CallableFunction|null = null

  constructor (
    private entangleable: Entangleable<any>,
    private wireModel: WireModel,
    preventInitialFill = false
  ) {
    this.entangleable = entangleable
    this.wireModel = wireModel
    this.livewire = window.Livewire.find(wireModel.livewireId)

    this.init()

    if (!preventInitialFill && isEmpty(this.entangleable.get())) {
      this.fillValueFromLivewire()
    }
  }

  private init () {
    this.livewire.watch(this.wireModel.name, (value: any) => {
      let entangleableValue = this.entangleable.get()

      if (this.toLivewireCallback) {
        entangleableValue = this.toLivewireCallback(entangleableValue)
      }

      if (JSON.stringify(entangleableValue) === JSON.stringify(value)) return

      if (this.fromLivewireCallback) {
        value = this.fromLivewireCallback(value)
      }

      this.entangleable.set(value)
    })

    this.entangleable.onClear(() => {
      this.livewire.$set(this.wireModel.name, null)
    })

    const IN_LIVE = true

    const modifiers = this.wireModel.modifiers

    const hasModifiers = modifiers.blur || modifiers.debounce.exists || modifiers.throttle.exists

    if (!hasModifiers) {
      this.entangleable.watch((value: any) => {
        this.set(value, this.wireModel.modifiers.live)
      })
    }

    if (modifiers.blur) {
      this.entangleable.onBlur((value: any) => this.set(value, IN_LIVE))
    }

    if (modifiers.debounce.exists) {
      this.entangleable.watch(debounce(
        (value: any) => this.set(value, IN_LIVE),
        modifiers.debounce.delay
      ))
    }

    if (modifiers.throttle.exists) {
      this.entangleable.watch(throttle(
        (value: any) => this.set(value, IN_LIVE),
        modifiers.throttle.delay
      ))
    }
  }

  set (value: any, isLive: boolean): this {
    if (this.toLivewireCallback) {
      value = this.toLivewireCallback(value)
    }

    if (this.livewire.get(this.wireModel.name) === value) return this

    this.livewire.$set(this.wireModel.name, value, isLive)

    return this
  }

  toLivewire (callback: CallableFunction): this {
    this.toLivewireCallback = callback

    return this
  }

  fromLivewire (callback: CallableFunction): this {
    this.fromLivewireCallback = callback

    return this
  }

  fillValueFromLivewire () {
    let value = this.livewire.get(this.wireModel.name)

    if (this.fromLivewireCallback) {
      value = this.fromLivewireCallback(value)
    }

    if (isEmpty(value)) return

    this.entangleable.set(value)
  }
}
