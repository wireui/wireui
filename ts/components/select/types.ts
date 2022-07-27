import { Entangle } from '@/components/alpine'
import { PositioningRefs } from '@/components/modules/positioning'
import { Template, TemplateName } from './templates'

export type Option = {
  [index: string]: any
  value: any
  label: string
  template?: TemplateName
  html?: string
  disabled?: boolean
  readonly?: boolean
}

export type TemplateConfig = {
  name: TemplateName,
  config: object
}

export type Options = Option[]

export type AsyncData = {
  api: string | null
  method: string
  params: any
  fetching: boolean
}

export type AsyncDataConfig = {
  api: string | null
  method: string
  params: any
}

export type InitOptions = {
  wireModel?: Entangle
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
}

export type Refs = PositioningRefs & {
  json: HTMLElement
  search?: HTMLInputElement
  input: HTMLInputElement
  slot: HTMLElement
  route: HTMLElement
  optionsContainer?: HTMLElement
}
