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
  month: number
  day: number
}

export type PreviousDate = iDate

export interface CurrentDate extends iDate {
  isToday: boolean
  date: string
}

export type NextDate = iDate

export interface LocaleDateConfig {
  year: 'numeric' | '2-digit' | undefined
  month: 'numeric' | '2-digit' | 'long' | 'short' | 'narrow' | undefined
  day: 'numeric' | '2-digit' | undefined
  timeZone: string | undefined
  hour?: 'numeric' | '2-digit' | undefined
  minute?: 'numeric' | '2-digit' | undefined
}

export interface DateTimePicker extends InitOptions {
  [index: string]: any

  localTimezone: string
  localeDateConfig: LocaleDateConfig
  searchTime: string | null
  input: Dateable | null
  modelTime: string | null | undefined
  popover: boolean
  tab: string
  monthsPicker: boolean
  previousDates: PreviousDate[]
  currentDates: CurrentDate[]
  nextDates: NextDate[]
  times: Time[]
  filteredTimes: Time[]
  month: number
  year: number

  init (): void
  clearDate (): void
  togglePicker (): void
  closePicker (): void
  handleEscape (): void
  initComponent (): void
  syncCalendar (): void
  getPreviousDates (currentDate: Dateable): PreviousDate[]
  getCurrentDates (currentDate: Dateable): CurrentDate[]
  getNextDates (currentDate: Dateable, datesLength: number): NextDate[]
  mustSyncDate (): boolean
  syncPickerDates (): void
  fillPickerDates (): void
  fillTimes (): void
  previousMonth (): void
  nextMonth (): void
  isSelected (date): boolean
  isToday (date): boolean
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
  onSearchTime (search): void
  focusTime (): void
}
