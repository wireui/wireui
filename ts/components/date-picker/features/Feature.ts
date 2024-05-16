import DatetimePicker from '@/components/date-picker'
import Events from '@/components/date-picker/features/Events'

export default abstract class Feature {
  constructor (protected component: DatetimePicker) {
    this.init()
  }

  get $events (): Events {
    return this.component.$events
  }

  init (): void {
  }
}
