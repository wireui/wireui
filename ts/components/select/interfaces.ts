import { Focusables } from '../modules/focusables'
import { Config, Option, Options, Refs } from './types'

export interface Select extends Focusables {
  $refs: Refs
  config: Config
  placeholder?: string
  popover: boolean
  search?: string
  selected?: Option
  selectedOptions: Options
  options: Options
  displayOptions: Options
  init (): void
  initOptionsObserver (): void
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
}
