import Entangleable from '@/alpine/proxy/Entangleable'
import { isEmpty } from '@/utils/helpers'

export default class SupportsAlpine {
  private entangleable: Entangleable

  private target: HTMLElement

  constructor (entangleable: Entangleable, target: HTMLElement) {
    this.entangleable = entangleable
    this.target = target

    if (isEmpty(this.entangleable.get())) {
      this.fillValueFromXModelable()
    }
  }

  private fillValueFromXModelable () {
    const xModelable = Array
      .from(this.target.attributes)
      .filter(attribute => attribute.name.startsWith('x-modelable'))
      .pop()

    if (!xModelable) return

    const value = window.Alpine.evaluate(this.target, xModelable.value)

    if (isEmpty(value)) return

    this.entangleable.set(value)
  }
}
