import { Day } from '@/components/date-picker/interfaces'

export type EVENT_PREVIOUS = 'previous'
export type EVENT_NEXT = 'next'
export type EVENT_SELECTED_DAY = 'selected::day'
export type EVENT_SELECTED_MONTH = 'selected::month'
export type EVENT_SELECTED_YEAR = 'selected::year'
export type EVENT_POPOVER = 'popover'
export type EVENT_CANCEL = 'cancel'
export type EVENT_CLEAR = 'clear'
export type EventType =
  EVENT_PREVIOUS
  |EVENT_NEXT
  |EVENT_SELECTED_DAY
  |EVENT_SELECTED_MONTH
  |EVENT_SELECTED_YEAR
  |EVENT_POPOVER
  |EVENT_CANCEL
  |EVENT_CLEAR

export default class Events {
  private handlers: { [index: string]: CallableFunction[] } = {}

  on (event: EVENT_SELECTED_YEAR, handler: (year: number) => void): void
  on (event: EVENT_SELECTED_MONTH, handler: (year: number, month: number) => void): void
  on (event: EVENT_SELECTED_DAY, handler: (day: Day) => void): void
  on (event: EVENT_POPOVER, handler: (state: boolean) => void): void
  on (event: EventType, handler: CallableFunction): void
  on (event: string, handler: CallableFunction): void {
    this.handlers[event] ??= []

    this.handlers[event].push(handler)
  }

  dispatch (event: EVENT_SELECTED_YEAR, year: number): void
  dispatch (event: EVENT_SELECTED_MONTH, year: number, month: number): void
  dispatch (event: EVENT_SELECTED_DAY, day: Day): void
  dispatch (event: EVENT_POPOVER, state: boolean): void
  dispatch (event: EventType, ...args: any[]): void
  dispatch (event: string, ...args: any[]): void {
    if (this.handlers[event]) {
      this.handlers[event].forEach(handler => handler(...args))
    }
  }

  off (event: EventType, handler: CallableFunction): void {
    this.handlers[event] ??= []

    const index = this.handlers[event].indexOf(handler)

    if (index !== -1) {
      this.handlers[event].splice(index, 1)
    }
  }
}
