import { Focusable } from '@/alpine/modules/Focusable'
import Positionable from '@/alpine/modules/Positionable'
import FluentDate from '@/utils/date'
import { CalendarConfig, Day, Tab, TimePicker } from './interfaces'
import { AlpineComponent } from '@/components/alpine2'
import { Entangleable, SupportsAlpine, SupportsLivewire } from '@/alpine/modules/entangleable'
import { AlpineModel, WireModel } from '@/components/alpine'
import Events from '@/components/date-picker/features/Events'
import MonthSelector from '@/components/date-picker/features/header/MonthSelector'
import YearsSelector from '@/components/date-picker/features/header/YearsSelector'
import Calendar from '@/components/date-picker/features/Calendar'
import Rollback from '@/components/date-picker/features/Rollback'

export default class DatetimePicker extends AlpineComponent {
  declare $refs: {
    popover: HTMLElement
    timesContainer: HTMLElement
    container: HTMLDivElement
    optionsContainer: HTMLDivElement
  }

  declare $props: {
    config: {
      requiresConfirmation: boolean
      readonly: boolean
      disabled: boolean
    }
    timezone: {
      enabled: boolean
      server: string
    }
    calendar: {
      weekDays: string[]
      startOfWeek: number
      monthNames: string[]
      min: string|null
      max: string|null
      allowedDates: string[]|string[][]
      disabled: {
        years: number[]|number[][]
        months: number[]
        weekdays: number[]
        dates: string[]|string[][]
        pastDates: boolean|string
      }
    }
    timePicker: {
      enabled: boolean
      interval: number
      is12H: boolean
      min: string|number
      max: string|number
    }
    input: {
      parseFormat: string
      displayFormat: string|null
    }
    wireModel: WireModel
    alpineModel: AlpineModel
  }

  localTimezone: string = FluentDate.getLocalTimezone()

  calendar: CalendarConfig = {
    dates: [],
    years: [],
    month: FluentDate.now().getMonth(),
    year: FluentDate.now().getYear(),
  }

  timePicker: TimePicker = {
    times: [],
    filteredTimes: [],
  }

  declare features: {
    monthSelector: MonthSelector
    yearsSelector: YearsSelector
    calendar: Calendar
    rollback: Rollback
  }

  tab: Tab = 'calendar'

  $events = new Events()

  positionable = new Positionable()

  focusable = new Focusable()

  entangleable = new Entangleable()

  selected: FluentDate|null = null

  get localeDateConfig (): Intl.DateTimeFormatOptions {
    const config: Intl.DateTimeFormatOptions = {
      year: 'numeric',
      month: 'numeric',
      day: 'numeric',
      timeZone: this.localTimezone,
    }

    if (this.$props.timePicker.enabled) {
      config.hour = 'numeric'
      config.minute = 'numeric'
    }

    return config
  }

  get display (): string|null {
    if (this.selected) {
      return this.$props.input.displayFormat
        ? this.selected.format(this.$props.input.displayFormat)
        : this.selected.getNativeDate().toLocaleString(navigator.language, this.localeDateConfig)
    }

    return null
  }

  get weekDays (): string[] {
    const weekDays = this.$props.calendar.weekDays
    const startOfWeek = this.$props.calendar.startOfWeek

    if (startOfWeek === 0) {
      return this.$props.calendar.weekDays
    }

    return weekDays.slice(startOfWeek).concat(weekDays.slice(0, startOfWeek))
  }

  init () {
    this.positionable
      .start(this, this.$refs.container, this.$refs.popover)
      .position('bottom')

    this.positionable.watch(state => {
      this.$events.dispatch('popover', state)

      if (state) {
        this.tab = 'calendar'
      }
    })

    this.focusable.start(this.$refs.optionsContainer, 'button, input')

    if (this.$props.wireModel.exists) {
      new SupportsLivewire(this.entangleable, this.$props.wireModel)
    }

    if (this.$props.alpineModel.exists) {
      new SupportsAlpine(this.$root, this.entangleable, this.$props.alpineModel)
    }

    this.setup()
  }

  setup () {
    this.features = {
      monthSelector: new MonthSelector(this),
      yearsSelector: new YearsSelector(this),
      calendar: new Calendar(this),
      rollback: new Rollback(this),
    }
  }

  clear () {
    this.selected = null

    this.$events.dispatch('clear')
  }

  cancel () {
    this.$events.dispatch('cancel')

    this.positionable.close()
  }

  toggleTab (tab: Tab) {
    if (this.tab === tab) {
      return (this.tab = 'calendar')
    }

    this.tab = tab
  }

  selectDay (day: Day) {
    this.selected = new FluentDate(day.date)
    this.calendar.year = this.selected.getYear()
    this.calendar.month = this.selected.getMonth()

    if (document.activeElement) {
      (document.activeElement as HTMLElement).blur()
    }

    this.$events.dispatch('selected::day', day)

    if (this.$props.timePicker.enabled) {
      return (this.tab = 'time-picker')
    }

    if (!this.$props.config.requiresConfirmation) {
      this.positionable.close()
    }
  }

  selectMonth (month: number) {
    this.calendar.month = month

    this.tab = 'calendar'

    this.$events.dispatch('selected::month', this.calendar.year, month)
  }

  selectYear (year: number) {
    this.calendar.year = year

    this.tab = 'calendar'

    this.$events.dispatch('selected::year', year)
  }

  previous () {
    this.$events.dispatch('previous')
  }

  next () {
    this.$events.dispatch('next')
  }

  goToday () {
    const now = FluentDate.now()

    this.calendar.year = now.getYear()
    this.calendar.month = now.getMonth()

    this.tab = 'calendar'

    this.$events.dispatch('selected::month', now.getYear(), now.getMonth())
  }

  shouldShowFooter () {
    return this.$props.config.requiresConfirmation
  }
}
