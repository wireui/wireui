import dayjs, { ConfigType, Dayjs, UnitType } from 'dayjs'
import customParseFormat from 'dayjs/plugin/customParseFormat'
import localizedFormat from 'dayjs/plugin/localizedFormat'
import isSameOrBefore from 'dayjs/plugin/isSameOrBefore'
import isBetween from 'dayjs/plugin/isBetween'
import timezone from 'dayjs/plugin/timezone'
import utc from 'dayjs/plugin/utc'

dayjs.extend(utc)
dayjs.extend(timezone)
dayjs.extend(customParseFormat)
dayjs.extend(localizedFormat)
dayjs.extend(isBetween)
dayjs.extend(isSameOrBefore)

export class FluentDate {
  private date: Dayjs

  static localTimezone: string|null = null

  timezone: string

  constructor (date: ConfigType, timezone: string|null = null, format: string|null = null) {
    this.timezone = timezone || FluentDate.getLocalTimezone()

    this.date = format
      ? dayjs.tz(date, format, this.timezone)
      : dayjs.tz(date, this.timezone)
  }

  static now (timezone: string|null = null, format: string|null = ''): FluentDate {
    return new FluentDate(dayjs(), timezone, format)
  }

  static parse (date: ConfigType, timezone: string|null = null, format: string|null = ''): FluentDate {
    return new FluentDate(date, timezone, format)
  }

  static getLocalTimezone (): string {
    return FluentDate.localTimezone || dayjs.tz.guess()
  }

  static setLocalTimezone (timezone: string): void {
    FluentDate.localTimezone = timezone
  }

  addDay (): FluentDate {
    this.date = this.date.add(1, 'day')

    return this
  }

  addDays (days: number): FluentDate {
    this.date = this.date.add(days, 'day')

    return this
  }

  addMonth (): FluentDate {
    this.date = this.date.add(1, 'month')

    return this
  }

  addMonths (months: number): FluentDate {
    this.date = this.date.add(months, 'month')

    return this
  }

  subMonth (): FluentDate {
    this.date = this.date.subtract(1, 'month')

    return this
  }

  subMonths (months: number): FluentDate {
    this.date = this.date.subtract(months, 'month')

    return this
  }

  subDay (): FluentDate {
    this.date = this.date.subtract(1, 'day')

    return this
  }

  subDays (days: number): FluentDate {
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

  getRealMonth (): number {
    return this.date.month() + 1
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

    return this.date.format('HH:mm:ss')
  }

  getHours (): number {
    return this.date.get('hours')
  }

  getMinutes (): number {
    return this.date.get('minutes')
  }

  getSeconds (): number {
    return this.date.get('seconds')
  }

  getNativeDate (): Date {
    return this.date.toDate()
  }

  setYear (year: number): FluentDate {
    this.date = this.date.set('year', year)

    return this
  }

  setMonth (month: number): FluentDate {
    this.date = this.date.set('month', month)

    return this
  }

  setDay (day: number): FluentDate {
    this.date = this.date.set('date', day)

    return this
  }

  setTime (time: string): FluentDate {
    const [hours = 0, minutes = 0, seconds = 0] = time.split(':')

    this.setHours(Number(hours))
    this.setMinutes(Number(minutes))
    this.setSeconds(Number(seconds))

    return this
  }

  setHours (hours: number): FluentDate {
    this.date = this.date.set('hours', hours)

    return this
  }

  setMinutes (minutes: number): FluentDate {
    this.date = this.date.set('minutes', minutes)

    return this
  }

  setSeconds (seconds: number): FluentDate {
    this.date = this.date.set('seconds', seconds)

    return this
  }

  setTimezone (timezone: string): FluentDate {
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

  clone (): FluentDate {
    return new FluentDate(this.date.clone(), this.timezone)
  }

  isValid (): boolean {
    return this.date.isValid()
  }

  isInvalid (): boolean {
    return !this.isValid()
  }

  isBefore (date: FluentDate|string, unit?: UnitType): boolean {
    if (date instanceof FluentDate) {
      return this.date.isBefore(date.date, unit)
    }

    return this.date.isBefore(String(date), unit)
  }

  isSameOrBefore (date: FluentDate|string, unit?: UnitType): boolean {
    if (date instanceof FluentDate) {
      return this.date.isSameOrBefore(date.date, unit)
    }

    return this.date.isSameOrBefore(String(date), unit)
  }

  isSame (date: FluentDate|string, unit?: UnitType): boolean {
    if (date instanceof FluentDate) {
      return this.date.isSame(date.date, unit)
    }

    return this.date.isSame(String(date), unit)
  }

  isAfter (date: FluentDate|string, unit?: UnitType): boolean {
    if (date instanceof FluentDate) {
      return this.date.isAfter(date.date, unit)
    }

    return this.date.isAfter(String(date), unit)
  }

  isBetween (start: FluentDate|string, end: FluentDate|string): boolean {
    if (start instanceof FluentDate && end instanceof FluentDate) {
      return this.date.isBetween(start.date, end.date, 'day', '[]')
    }

    return this.date.isBetween(String(start), String(end), 'day', '[]')
  }

  isToday (): boolean {
    const today = dayjs.tz(new Date(), this.timezone)

    return this.date.isSame(today, 'date')
  }

  toJson (): string {
    return this.date.toJSON()
  }

  toIsoString (timezone?: string): string {
    let format = 'YYYY-MM-DDTHH:mm:ss'

    if (timezone) {
      format += 'Z'
    }

    return this.format(format, timezone)
  }

  toDateString(): string {
    return this.date.format('YYYY-MM-DD')
  }

  toString (): string {
    return this.toJson()
  }
}

export const getLocalTimezone = (): string => {
  return dayjs.tz.guess()
}

export interface ParseDate {
  (date: ConfigType, timezone?: string, format?: string): FluentDate
}

// todo: delete date helper
export const date: ParseDate = (date: ConfigType, timezone: string|null = null, format: string|null = null): FluentDate => {
  return new FluentDate(date, timezone, format)
}

export default FluentDate
