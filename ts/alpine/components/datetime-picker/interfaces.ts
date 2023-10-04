import { WireModel } from '@/livewire'

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
  monthNames: string[]
  withoutTime: boolean
  wireModel: WireModel
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

export type Refs = {
  timesContainer: HTMLElement
  popover: HTMLElement
}
