export default class Entangleable {
  private callbacks: CallableFunction[] = []

  private onBlurCallbacks: CallableFunction[] = []

  value: any = null

  set (value: any, { force = false, triggerBlur = false } = {}) {
    if (this.value === value && !force) return

    this.value = value

    this.callbacks.forEach(callback => callback(value))

    if (triggerBlur) {
      this.executeBlurCallbacks()
    }
  }

  get () {
    return this.value
  }

  onBlur (value: any) {
    this.set(value, { force: true })

    this.executeBlurCallbacks()
  }

  executeBlurCallbacks () {
    this.onBlurCallbacks.forEach(callback => callback(this.value))
  }

  watch (callback: CallableFunction) {
    this.callbacks.push(callback)
  }

  executeOnBlur (callback: CallableFunction) {
    this.onBlurCallbacks.push(callback)
  }
}
