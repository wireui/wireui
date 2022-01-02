import { Dateable } from '../../utils/date'
import { Entangle } from '../alpine'
import { Time } from './makeTimes'

export interface InitOptions {
  model: Entangle
  config: {
    interval: number
    is12H: boolean
    readonly: boolean
    disabled: boolean
    min?: string | null
    max?: string | null
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

export interface DateTimePicker extends InitOptions {
  [index: string]: any

  localTimezone: string
  localeDateConfig: LocaleDateConfig
  searchTime: string | null
  input: Dateable | null
  modelTime: string | null | undefined
  popover: boolean
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
  clearDate (): void
  togglePicker (): void
  closePicker (): void
  handleEscape (): void
  syncCalendar (): void
  getPreviousDates (currentDate: Dateable): PreviousDate[]
  getCurrentDates (currentDate: Dateable): CurrentDate[]
  getNextDates (currentDate: Dateable, datesLength: number): NextDate[]
  isDateDisabled (date: iDate): boolean
  mustSyncDate (): boolean
  syncPickerDates (forceSync?: boolean): void
  fillPickerDates (): void
  fillTimes (): void
  filterTimes (times: Time[]): Time[]
  previousMonth (): void
  nextMonth (): void
  isSelected (date: CurrentDate): boolean
  isToday (day: number): boolean
  selectMonth (month: number): void
  emitInput (): void
  syncInput (): void
  selectDate (date: iDate): void
  selectTime (time: Time): void
  today (): Dateable
  selectYesterday (): void
  selectToday (): void
  selectTomorrow (): void
  getLocaleDateConfig (): LocaleDateConfig
  getDisplayValue (): string | undefined
  onSearchTime (search: string): void
  makeSearchTimes (search: string): Time[]
  focusTime (): void
}
