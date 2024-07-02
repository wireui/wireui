import { watchProps } from '@/alpine/magic/props'
import { Entangleable, SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'
import { AlpineComponent } from '@/components/alpine2'
import { Period, toMilitaryFormat, toStandardFormat } from '@/components/TimeSelector/helpers'
import ScrollableOptions from '@/components/TimeSelector/ScrollableOptions'
import { WireModel } from '@/livewire'
import FluentDate from '@/utils/date'
import { AlpineModel } from '@/components/alpine'

export type Selection = {
  hours: number
  minutes: number
  seconds: number
  period: Period|false
}

export default class TimeSelector extends AlpineComponent {
  declare $refs: {
    hours: HTMLUListElement
    minutes: HTMLUListElement
    seconds: HTMLUListElement
    period: HTMLUListElement
    input: HTMLInputElement
  }

  declare $props: {
    militaryTime: boolean
    withoutSeconds: boolean
    disabled: boolean
    readonly: boolean
    wireModel: WireModel
    alpineModel: AlpineModel
  }

  private scrollable: {
    hours: ScrollableOptions,
    minutes: ScrollableOptions,
    seconds: ScrollableOptions,
    period: ScrollableOptions
  } = {} as any

  private date = new FluentDate(new Date())

  public entangleable = new Entangleable<string>()

  public timeInput: string|null = null

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

  init (): void {
    this.syncProps()
    this.makeOptions()

    if (!this.timeInput && this.$refs.input.value) {
      this.timeInput = this.$refs.input.value
    }

    if (this.timeInput) {
      this.syncTimeSelection(this.timeInput)
    }

    this.$safeWatch('selection', () => {
      this.$skipNextWatcher('timeInput', () => {
        this.timeInput = this.makeTime()
        this.entangleable.set(this.timeInput)
      })
    })

    this.$safeWatch('timeInput', () => {
      this.syncTimeSelection(this.timeInput)
    })

    this.entangleable.watch(time => this.syncTimeSelection(time))

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    if (this.$props.alpineModel.exists) {
      new SupportsAlpine(this.$root, this.entangleable, this.$props.alpineModel)
    }

    watchProps(this, () => this.syncProps())
  }

  private syncProps () {
    this.config.military = this.$props.militaryTime
    this.config.seconds = !this.$props.withoutSeconds

    if (this.config.military) {
      this.selection.period = false
    }
  }

  private syncTimeSelection (time: string|null): void {
    let [hours, minutes, seconds] = time?.split(':') ?? [0, 0, 0]

    let period: Period|false = false

    if (!this.config.military) {
      const timePeriod = toStandardFormat(Number(hours))

      hours = timePeriod.hours
      period = timePeriod.period
    }

    this.$skipNextWatcher('selection', () => {
      this.selection = {
        minutes: Number(minutes) || 0,
        seconds: Number(seconds) || 0,
        hours: Number(hours),
        period
      }
    })

    this.scrollable.hours.setCurrent(this.selection.hours).render()
    this.scrollable.minutes.setCurrent(this.selection.minutes).render()
    this.scrollable.seconds.setCurrent(this.selection.seconds).render()
    this.scrollable.period.setCurrent(this.selection.period).resetTopPosition().render()
  }

  private makeTime (): string|null {
    let hours = this.selection.hours

    if (!this.config.military && this.selection.period) {
      hours = toMilitaryFormat(this.selection.period, this.selection.hours)
    }

    this.date.setHours(hours)
    this.date.setMinutes(this.selection.minutes)
    this.date.setSeconds(this.selection.seconds)

    return this.$props.withoutSeconds
      ? this.date.format('HH:mm')
      : this.date.format('HH:mm:ss')
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
      this.selection.hours
    )
      .onChange((hours: number) => {
        this.selection.hours = hours
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
      })
      .start()
  }

  private getHoursOptions (): number[] {
    return this.$props.militaryTime
      ? this.makeArray(24).map(hour => hour)
      : this.makeArray(12).map(hour => ++hour)
  }

  private makeArray (length: number): number[] {
    return Array.from({ length }, (_, i) => i)
  }
}
