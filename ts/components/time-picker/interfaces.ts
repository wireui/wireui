import { Focusable } from '@/alpine/modules/Focusable'
import Positionable from '@/alpine/modules/Positionable'
import { Component, Entangle } from '@/components/alpine'
import { Time } from '@/components/datetime-picker/makeTimes'
import { PositioningRefs } from '@/components/modules/positioning'

export type Refs = PositioningRefs & {
  search: HTMLInputElement
  container: HTMLDivElement
  optionsContainer: HTMLDivElement
}

export type Config = {
  isBlur: boolean
  interval: number
  format: string
  is12H: boolean
  readonly: boolean
  disabled: boolean
}

export interface InitOptions {
  model: Entangle
  config: Config
}

export interface TimePicker extends Component {
  $refs: Refs
  model: Entangle
  input: string | null
  config: Config
  search: string
  times: Time[]
  filteredTimes: Time[]
  positionable: Positionable
  focusable: Focusable

  init (): void
  maskInput (value: string | null): string | null
  clearInput (): void
  fillTimes (): void
  selectTime (time: Time): void
  onInput (value: string): void
  onSearch (search: string): void
  makeSearchTimes (search: string): Time[]
  emitInput (): void
  convertTo24Hours (time12h: string | null): string
  convertTo12Hours (time24: string | null): string
  convertModelTime (dateTime: string | null): string
  hasDate (value: string): boolean
  hasTime (value: string): boolean
  getTimeFromDate (dateTime: string): string | null
}
