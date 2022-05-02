import { Entangle } from '../alpine'
import { Focusables } from '../modules/focusables'
import { Config, Option, Options, Refs } from './types'

export interface Select extends Focusables {
  $refs: Refs
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
  initWireModelWatchers (): void
  initOptionsObserver (): void
  initSlotObserver (): void
  syncSlotOptions (): void
  fillSelectedFromInputValue (): void
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
