import { Entangle } from '../alpine'
import { Focusables } from '../modules/focusables'
import { AsyncData, Config, Option, Options, Refs } from './types'

export interface Select extends Focusables {
  $refs: Refs
  asyncData: AsyncData
  config: Config
  placeholder?: string
  popover: boolean
  search?: string
  wireModel?: Entangle
  selected?: Option
  selectedOptions: Options
  options: Options
  displayOptions: Options
  get hasWireModel (): boolean
  init (): void
  initWatchers (): void
  initWireModel (): void
  initOptionsObserver (): void
  initSlotObserver (): void
  syncSlotOptions (): void
  fetchOptions (): void
  fetchSelected (): void
  mapOption (option: any): Option
  fillSelectedFromInputValue (): void
  syncSelectedFromWireModel (): void
  mustSyncWireModel (): boolean
  searchOptions (search: string): Options
  togglePopover (): void
  closePopover (): void
  getSelectedValue (): any
  getSelectedDysplayText (): string
  getPlaceholder (): string
  isSelected (option: Option): boolean
  select (option: Option): void
  unSelect (option: Option): void
  clear (): void
  isEmpty (): boolean
  renderOption (option: Option): string
}
