import { AlpineComponent } from '@/components/alpine2'
import ScrollableOptions from '@/components/TimeSelector/ScrollableOptions'

export default class TimeSelector extends AlpineComponent {
  declare $refs: {
    hours: HTMLUListElement
    minutes: HTMLUListElement
    seconds: HTMLUListElement
  }

  init () {
    this.makeOptions()
  }

  makeOptions () {
    const hours = this.makeArray(12).map(i => ++i)
    const minutes = this.makeArray(60)
    const seconds = this.makeArray(60)

    new ScrollableOptions(this.$refs.hours, hours, 1).start()
    new ScrollableOptions(this.$refs.minutes, minutes, 0).start()
    new ScrollableOptions(this.$refs.seconds, seconds, 0).start()
  }

  makeArray (length: number): number[] {
    return Array.from({ length }, (_, i) => i)
  }
}
