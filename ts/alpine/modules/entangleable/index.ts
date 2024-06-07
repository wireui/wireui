import { isEmpty } from '@/utils/helpers'
import SupportsAlpine from './SupportsAlpine'
import SupportsLivewire from './SupportsLivewire'

export { SupportsLivewire, SupportsAlpine }

export class Entangleable<TValue> {
  protected onSetCallbacks: CallableFunction[] = []

  protected onClearCallbacks: CallableFunction[] = []

  protected onBlurCallbacks: CallableFunction[] = []

  protected value: TValue|null = null

  set (value: TValue|null, { force = false, triggerBlur = false } = {}) {
    if (this.value === value && !force) return

    this.value = value

    this.runSetCallbacks()

    if (triggerBlur) {
      this.onBlurCallbacks.forEach(callback => callback(this.value))
    }
  }

  get (): TValue|null {
    return this.value
  }

  clear ($default: TValue|null = null) {
    this.value = $default

    this.onClearCallbacks.forEach(callback => callback())
  }

  watch (callback: (value: TValue|null) => void) {
    this.onSetCallbacks.push(callback)
  }

  onBlur (callback: CallableFunction) {
    this.onBlurCallbacks.push(callback)
  }

  onClear (callback: (value: TValue|null) => void) {
    this.onClearCallbacks.push(callback)
  }

  runSetCallbacks () {
    this.onSetCallbacks.forEach(callback => callback(this.value))
  }

  isEmpty (): boolean {
    return isEmpty(this.value)
  }

  isNotEmpty (): boolean {
    return !this.isEmpty()
  }
}

export default Entangleable
