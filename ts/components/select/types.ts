import { PositioningRefs } from '@/components/modules/positioning'
import { Template, TemplateName } from './templates'
import { AlpineModel, WireModel } from '@/components/alpine'

export type Option = {
  [index: string]: any
  value: any
  label: string
  template?: TemplateName
  html?: string
  disabled?: boolean
  readonly?: boolean
  isSelected?: boolean
}

export type TemplateConfig = {
  name: TemplateName,
  config: object
}

export type Options = Option[]

export type AsyncDataConfig = {
  api: string | null
  method: string
  optionsPath: string | null
  params: any
  alwaysFetch: boolean,
  credentials?: RequestCredentials
}

export type AsyncData = AsyncDataConfig & {
  fetching: boolean
}

export type Config = {
  hasSlot: boolean
  searchable: boolean
  multiselect: boolean
  clearable: boolean
  readonly: boolean
  disabled: boolean
  placeholder: string | null
  optionValue: string | null
  optionLabel: string | null
  optionDescription: string | null
  template: Template
}

export type Props = Config & {
  asyncData: AsyncDataConfig
  template: TemplateConfig
  wireModel: WireModel
  alpineModel: AlpineModel
}

export type Refs = PositioningRefs & {
  search?: HTMLInputElement
  input: HTMLInputElement
  json: HTMLElement
  slot: HTMLElement
  optionsContainer?: HTMLElement
  listing: HTMLElement
  container: HTMLElement
}
