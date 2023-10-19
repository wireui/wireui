import { isEmpty } from '@/utils/helpers'
import SupportsAlpine from './SupportsAlpine'
import SupportsLivewire from './SupportsLivewire'

export { SupportsLivewire, SupportsAlpine }

export class Entangleable {
  private onSetCallbacks: CallableFunction[] = []

  private onClearCallbacks: CallableFunction[] = []

  private onBlurCallbacks: CallableFunction[] = []

  private value: any = null

  set (value: any, { force = false, triggerBlur = false } = {}) {
    if (this.value === value && !force) return

    this.value = value

    this.onSetCallbacks.forEach(callback => callback(value))

    if (triggerBlur) {
      this.onBlurCallbacks.forEach(callback => callback(this.value))
    }
  }

  get () {
    return this.value
  }

  clear ($default = null) {
    this.value = $default

    this.onClearCallbacks.forEach(callback => callback())
  }

  watch (callback: CallableFunction) {
    this.onSetCallbacks.push(callback)
  }

  onBlur (callback: CallableFunction) {
    this.onBlurCallbacks.push(callback)
  }

  onClear (callback: CallableFunction) {
    this.onClearCallbacks.push(callback)
  }

  isEmpty (): boolean {
    return isEmpty(this.value)
  }
}
