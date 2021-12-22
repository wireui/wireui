import dayjs, { ConfigType, Dayjs, UnitType } from 'dayjs'
import utc from 'dayjs/plugin/utc'
import timezone from 'dayjs/plugin/timezone'
import customParseFormat from 'dayjs/plugin/customParseFormat'
import localizedFormat from 'dayjs/plugin/localizedFormat'
dayjs.extend(utc)
dayjs.extend(timezone)
dayjs.extend(customParseFormat)
dayjs.extend(localizedFormat)

export type Dateable = {
  timezone: string
  addMonth (): Dateable
  addMonths (months: number): Dateable
  addDay (): Dateable
  addDays (days: number): Dateable
  subMonth (): Dateable
  subMonths (months: number): Dateable
  subDay (): Dateable
  subDays (days: number): Dateable
  getMonthDays (): number
  getYear (): number
  getMonth (): number
  getDay (): number
  getDayOfWeek (): number
  getTime (timezone?: string): string
  getHours (): number
  getMinutes (): number
  getNativeDate (): Date
  setYear (year: number): Dateable
  setMonth (month: number): Dateable
  setDay (day: number): Dateable
  setTime (time: string): Dateable
  setHours (hours: number): Dateable
  setMinutes (minutes: number): Dateable
  setTimezone (timezone: string): Dateable
  format (format: string, timezone?: string): string
  clone (): Dateable
  isValid (): boolean
  isInvalid (): boolean
  isBefore (date: Dateable | string, unit?: UnitType): boolean
  isSame (date: Dateable | string, unit?: UnitType): boolean
  isAfter (date: Dateable | string, unit?: UnitType): boolean
  toJson (): string
}

export class FluentDate implements Dateable {
  timezone: string
  private date: Dayjs

  constructor (date: ConfigType, timezone = 'UTC', format = '') {
    this.timezone = timezone
    this.date = format
      ? dayjs.tz(date, format, timezone)
      : dayjs.tz(date, timezone)
  }

  addDay (): Dateable {
    this.date = this.date.add(1, 'day')

    return this
  }

  addDays (days: number): Dateable {
    this.date = this.date.add(days, 'day')

    return this
  }

  addMonth (): Dateable {
    this.date = this.date.add(1, 'month')

    return this
  }

  addMonths (months: number): Dateable {
    this.date = this.date.add(months, 'month')

    return this
  }

  subMonth (): Dateable {
    this.date = this.date.subtract(1, 'month')

    return this
  }

  subMonths (months: number): Dateable {
    this.date = this.date.subtract(months, 'month')

    return this
  }

  subDay (): Dateable {
    this.date = this.date.subtract(1, 'day')

    return this
  }

  subDays (days: number): Dateable {
    this.date = this.date.subtract(days, 'day')

    return this
  }

  getMonthDays (): number {
    return this.date.daysInMonth()
  }

  getYear (): number {
    return this.date.year()
  }

  getMonth (): number {
    return this.date.month()
  }

  getDay (): number {
    return this.date.date()
  }

  getDayOfWeek (): number {
    return this.date.day()
  }

  getTime (timezone?: string): string {
    if (timezone) {
      return this.clone().setTimezone(timezone).getTime()
    }

    return this.date.format('HH:mm')
  }

  getHours (): number {
    return this.date.get('hours')
  }

  getMinutes (): number {
    return this.date.get('minutes')
  }

  getNativeDate (): Date {
    return this.date.toDate()
  }

  setYear (year: number): Dateable {
    this.date = this.date.set('year', year)

    return this
  }

  setMonth (month: number): Dateable {
    this.date = this.date.set('month', month)

    return this
  }

  setDay (day: number): Dateable {
    this.date = this.date.set('date', day)

    return this
  }

  setTime (time: string): Dateable {
    const [hours = 0, minutes = 0] = time.split(':')

    this.setHours(Number(hours))
    this.setMinutes(Number(minutes))

    return this
  }

  setHours (hours: number): Dateable {
    this.date = this.date.set('hours', hours)

    return this
  }

  setMinutes (minutes: number): Dateable {
    this.date = this.date.set('minutes', minutes)

    return this
  }

  setTimezone (timezone: string): Dateable {
    this.date = this.date.tz(timezone)
    this.timezone = timezone

    return this
  }

  format (format: string, timezone?: string): string {
    if (timezone) {
      return this.clone().setTimezone(timezone).format(format)
    }

    return this.date.format(format)
  }

  clone (): Dateable {
    return new FluentDate(this.date, this.timezone)
  }

  isValid (): boolean {
    return this.date.isValid()
  }

  isInvalid (): boolean {
    return !this.isValid()
  }

  isBefore (date: Dateable | string, unit?: UnitType): boolean {
    if (date instanceof FluentDate) {
      return this.date.isBefore(date.date, unit)
    }

    return this.date.isBefore(String(date), unit)
  }

  isSame (date: Dateable | string, unit?: UnitType): boolean {
    if (date instanceof FluentDate) {
      return this.date.isSame(date.date, unit)
    }

    return this.date.isSame(String(date), unit)
  }

  isAfter (date: Dateable | string, unit?: UnitType): boolean {
    if (date instanceof FluentDate) {
      return this.date.isAfter(date.date, unit)
    }

    return this.date.isAfter(String(date), unit)
  }

  toJson (): string {
    return this.date.toJSON()
  }
}

export const getLocalTimezone = (): string => {
  return dayjs.tz.guess()
}

export interface ParseDate {
  (date: ConfigType, timezone?: string, format?: string): Dateable
}

export const date: ParseDate = (date: ConfigType, timezone = 'UTC', format = ''): Dateable => {
  return new FluentDate(date, timezone, format)
}

export default FluentDate
