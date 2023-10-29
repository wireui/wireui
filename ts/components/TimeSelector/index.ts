import { watchProps } from '@/alpine/magic/props'
import { Entangleable, SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'
import { AlpineComponent } from '@/components/alpine2'
import { toAmPmFormat, toMilitaryFormat } from '@/components/TimeSelector/helpers'
import ScrollableOptions from '@/components/TimeSelector/ScrollableOptions'
import { WireModel } from '@/livewire'
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
    wireModel: WireModel
    militaryTime: boolean
    format: string
    disabled: boolean
    readonly: boolean
  }

  declare private scrollable: {
    hours: ScrollableOptions,
    minutes: ScrollableOptions,
    seconds: ScrollableOptions,
    period: ScrollableOptions
  }

  private date = new FluentDate(new Date())

  public entangleable = new Entangleable()

  public selection: Selection = {
    hours: 12,
    minutes: 0,
    seconds: 0,
    period: 'AM'
  }

  public config = {
    military: false,
    seconds: false
  }

  get value (): string {
    this.date.setHours(toMilitaryFormat(this.selection.period, this.selection.hours))
    this.date.setMinutes(this.selection.minutes)
    this.date.setSeconds(this.selection.seconds)

    return this.date.format(this.$props.format)
  }

  init (): void {
    this.entangleable.watch(() => this.syncSelection())

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    new SupportsAlpine(this.entangleable, this.$refs.input)

    this.syncProps()

    this.fillSelectionFromInput()

    this.makeOptions()

    watchProps(this, () => {
      this.syncProps()

      this.scrollable.hours
        .setElements(this.getHoursOptions())
        .setCurrent(
          this.scrollable.hours.value() >= 12
            ? this.scrollable.hours.value() - 12
            : this.scrollable.hours.value()
        )
        .render()
    })
  }

  private syncProps () {
    this.config.military = this.$props.militaryTime
    this.config.seconds = this.$props.format.includes('ss')
  }

  private syncSelection (): void { 
    const [rawHours, minutes, seconds] = this.entangleable.get()?.split(':') ?? []

    const hours = Number(rawHours) || 0
    const period = hours >= 12 ? 'PM' : 'AM'

    this.selection.hours = toAmPmFormat(period, hours)
    this.selection.minutes = Number(minutes) || 0
    this.selection.seconds = Number(seconds) || 0
    this.selection.period = period
  }

  private fillSelectionFromInput (): void {
    const value = this.$refs.input.value

    if (!value) {
      return
    }

    this.entangleable.set(value)
  }

  private makeOptions (): void {
    this.scrollable = {} as any

    this.setupHoursCol()
    this.setupMinutesCol()
    this.setupSecondsCol()
    this.setupPeriodCol()
  }

  private setupHoursCol (): void {
    const hours = this.getHoursOptions()

    this.scrollable.hours = new ScrollableOptions(
      this.$refs.hours,
      hours,
      this.getMilitaryHour()
    )
      .onChange((hours: number) => {
        this.selection.period = hours >= 12 ? 'PM' : 'AM'

        this.selection.hours = this.$props.militaryTime
          ? toMilitaryFormat(this.selection.period, hours)
          : toAmPmFormat(this.selection.period, hours)
      })
      .start()
  }

  private setupMinutesCol (): void {
    const minutes = this.makeArray(60)

    this.scrollable.minutes = new ScrollableOptions(
      this.$refs.minutes,
      minutes,
      this.selection.minutes
    )
      .onChange((minutes: number) => {
        this.selection.minutes = minutes

        this.entangleable.set(this.value)
      })
      .start()
  }

  private setupSecondsCol (): void {
    const seconds = this.makeArray(60)

    this.scrollable.seconds = new ScrollableOptions(
      this.$refs.seconds,
      seconds,
      this.selection.seconds
    )
      .onChange((seconds: number) => {
        this.selection.seconds = seconds

        this.entangleable.set(this.value)
      })
      .start()
  }

  private setupPeriodCol (): void {
    this.scrollable.period = new ScrollableOptions(
      this.$refs.period,
      ['AM', 'PM'],
      this.selection.period
    )
      .setInfinity(false)
      .useCustomTopGap(function (this: ScrollableOptions) {
        return this.current === 'AM' ? 14 : -15
      })
      .onChange((period: Period) => {
        this.selection.period = period

        this.entangleable.set(this.value)
      })
      .start()
  }

  private getHoursOptions (): number[] {
    return this.$props.militaryTime
      ? this.makeArray(24).map(hour => hour)
      : this.makeArray(12).map(hour => ++hour)
  }

  private getMilitaryHour (): number {
    return this.$props.militaryTime
      ? toMilitaryFormat(this.selection.period, this.selection.hours)
      : toAmPmFormat(this.selection.period, this.selection.hours)
  }

  private makeArray (length: number): number[] {
    return Array.from({ length }, (_, i) => i)
  }
}
