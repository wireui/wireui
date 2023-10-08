import { AlpineComponent } from '@/alpine/components/alpine'
import { Time } from '@/alpine/components/datetime-picker/makeTimes'
import { Refs } from './interfaces'

export default class TimePicker extends AlpineComponent {
  declare $refs: Refs

  input: string|null = null

  search: string|null = null

  times: Time[] = []

  filteredTimes: Time[] = []
}
