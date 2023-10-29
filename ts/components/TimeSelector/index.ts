import { AlpineComponent } from '@/components/alpine2'
import { toAmPmFormat, toMilitaryFormat } from '@/components/TimeSelector/helpers'
import ScrollableOptions from '@/components/TimeSelector/ScrollableOptions'
import FluentDate from '@/utils/date'

export type Selection = {
  hours: number
  minutes: number
  seconds: number
  period: Period
}

export type Period = 'AM'|'PM'

export default class TimeSelector extends AlpineComponent {
  declare $refs: {
    hours: HTMLUListElement
    minutes: HTMLUListElement
    seconds: HTMLUListElement
    period: HTMLUListElement
    input: HTMLInputElement
  }

  declare $props: {
    seconds: boolean
    format: string
    disabled: boolean
    readonly: boolean
  }

  private date: FluentDate = new FluentDate(new Date())

  public selection: Selection = {
    hours: 12,
    minutes: 0,
    seconds: 0,
    period: 'AM'
  }

  get value (): string {
    this.date.setHours(toMilitaryFormat(this.selection.period, this.selection.hours))
    this.date.setMinutes(this.selection.minutes)
    this.date.setSeconds(this.selection.seconds)

    return this.date.format(this.$props.format)
  }

  init (): void {
    this.fillSelectionFromInput()

    this.makeOptions()
  }

  private fillSelectionFromInput (): void {
    const value = this.$refs.input.value

    if (!value) {
      return
    }

    const [rawHours, minutes, seconds] = value.split(':')

    const hours = Number(rawHours) || 0
    const period = hours >= 12 ? 'PM' : 'AM'

    this.selection.hours = toAmPmFormat(period, hours)
    this.selection.minutes = Number(minutes) || 0
    this.selection.seconds = Number(seconds) || 0
    this.selection.period = period
  }

  private makeOptions (): void {
    const hours = this.makeArray(12).map(i => ++i)
    const minutes = this.makeArray(60)
    const seconds = this.makeArray(60)

    new ScrollableOptions(this.$refs.hours, hours, this.selection.hours)
      .onChange((hours: number) => {
        this.selection.hours = hours
      })
      .start()

    new ScrollableOptions(this.$refs.minutes, minutes, this.selection.minutes)
      .onChange((minutes: number) => {
        this.selection.minutes = minutes
      })
      .start()

    new ScrollableOptions(this.$refs.seconds, seconds, this.selection.seconds)
      .onChange((seconds: number) => {
        this.selection.seconds = seconds
      })
      .start()

    new ScrollableOptions(this.$refs.period, ['AM', 'PM'], this.selection.period)
      .setInfinity(false)
      .useCustomTopGap(function (this: ScrollableOptions) {
        return this.current === 'AM' ? 14 : -15
      })
      .onChange((period: Period) => {
        this.selection.period = period
      })
      .start()
  }

  private makeArray (length: number): number[] {
    return Array.from({ length }, (_, i) => i)
  }
}
