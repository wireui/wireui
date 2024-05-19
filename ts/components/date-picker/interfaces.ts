import { Year } from '@/components/date-picker/features/header/YearsSelector'

export type Tab = 'calendar'|'time-picker'|'months-picker'|'years-picker'

export type CalendarConfig = {
  dates: Day[],
  years: Year[],
  month: number,
  year: number
}

export interface Day {
  date: string
  year: number
  month: number
  number: number
  isDisabled: boolean
  isToday: boolean
  isSelected: boolean
  isSelectedMonth: boolean
}
