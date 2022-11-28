import { Dateable } from '@/utils/date'
import { Component, Entangle } from '@/components/alpine'
import { Time } from './makeTimes'
import { Positioning, PositioningRefs } from '@/components/modules/positioning'

export interface InitOptions {
  model: Entangle
}

export interface Props {
  config: {
    interval: number
    is12H: boolean
    readonly: boolean
    disabled: boolean
    min?: string | null
    max?: string | null
    minTime?: string | number
    maxTime?: string | number
  }
  withoutTimezone: boolean
  timezone: string
  userTimezone: string
  parseFormat: string
  displayFormat: string
  weekDays: string[]
  monthNames: string[]
  withoutTime: boolean
}

export interface iDate {
  year: number
  month: number
  day: number
  isDisabled: boolean
}

export type PreviousDate = iDate

export interface CurrentDate extends iDate {
  isToday: boolean
  isSelected: boolean
  date: string
}

export type NextDate = iDate

export interface LocaleDateConfig {
  year?: 'numeric' | '2-digit'
  month?: 'numeric' | '2-digit' | 'long' | 'short' | 'narrow'
  day?: 'numeric' | '2-digit'
  timeZone?: string
  hour?: 'numeric' | '2-digit'
  minute?: 'numeric' | '2-digit'
}

export type Refs = PositioningRefs & {
  timesContainer: HTMLElement
}

export interface DateTimePicker extends Component, InitOptions, Props, Positioning {
  $refs: Refs
  $props: Props,
  localTimezone: string
  localeDateConfig: LocaleDateConfig
  searchTime: string | null
  input: Dateable | null
  modelTime: string | null | undefined
  tab: 'date' | 'time'
  monthsPicker: boolean
  previousDates: PreviousDate[]
  currentDates: CurrentDate[]
  nextDates: NextDate[]
  times: Time[]
  filteredTimes: Time[]
  month: number
  year: number
  minDate: Dateable | null
  maxDate: Dateable | null

  get dates (): iDate[]

  init (): void
  initComponent (): void
  syncProps (): void
  syncDateLimits (): void
  clearDate (): void
  syncCalendar (): void
  getPreviousDates (currentDate: Dateable): PreviousDate[]
  getCurrentDates (currentDate: Dateable): CurrentDate[]
  getNextDates (currentDate: Dateable, datesLength: number): NextDate[]
  isDateDisabled (date: iDate): boolean
  syncPickerDates (forceSync?: boolean): void
  fillPickerDates (): void
  fillTimes (): void
  filterTimes (times: Time[]): Time[]
  previousMonth (): void
  nextMonth (): void
  isSelected (date: CurrentDate): boolean
  isToday (day: number): boolean
  selectMonth (month: number): void
  syncWireModel (): void
  syncInput (): void
  selectDate (date: iDate): void
  selectTime (time: Time): void
  today (): Dateable
  selectYesterday (): void
  selectToday (): void
  selectTomorrow (): void
  getLocaleDateConfig (): LocaleDateConfig
  getDisplayValue (): string | undefined
  getSearchPlaceholder (): string
  onSearchTime (search: string): void
  makeSearchTimes (search: string): Time[]
  focusTime (): void
}
