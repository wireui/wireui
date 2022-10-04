import { Entangle } from '@/components/alpine'
import { Focusables } from '@/components/modules/focusables'
import { Positioning } from '@/components/modules/positioning'
import { AsyncData, Config, Option, Options, Props, Refs } from './types'

export interface Select extends Focusables, Positioning {
  $refs: Refs
  $props: Props,
  asyncData: AsyncData
  config: Config
  search: string | null
  wireModel?: Entangle
  selected?: Option
  selectedOptions: Options
  options: Options
  displayOptions: Options
  get hasWireModel (): boolean
  init (): void
  initRenderObserver (): void
  initWatchers (): void
  initDeferredWatchers (): void
  initWireModel (): void
  initOptionsObserver (): void
  initSlotObserver (): void
  syncProps (): void
  syncJsonOptions (): void
  syncSlotOptions (): void
  makeRequest (params: any): Request
  fetchOptions (): void
  fetchSelected (): void
  mapOption (option: any): Option
  setOptions (options: Options): void
  syncSelectedOptions (): void
  fillSelectedFromInputValue (): void
  syncSelectedFromWireModel (): void
  mustSyncWireModel (): boolean
  searchOptions (search: string): Options
  closeIfNotFocused (): void
  getValue (): any[]
  getSelectedValue (): any
  getSelectedDisplayText (): string
  getPlaceholder (): string
  isSelected (option: Option): boolean
  select (option: Option): void
  unSelect (option: Option): void
  clear (): void
  isEmpty (): boolean
  renderOption (option: Option): string
}
