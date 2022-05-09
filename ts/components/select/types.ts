import { Entangle } from '../alpine'
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
  api?: string
  fetching: boolean
}

export type InitOptions = {
  asyncData?: string
  hasSlot: boolean
  searchable: boolean
  multiselect: boolean
  readonly: boolean
  disabled: boolean
  placeholder: string
  optionValue?: string
  optionLabel?: string
  optionDescription?: string
  template?: TemplateConfig
  wireModel?: Entangle
}

export type Config = {
  hasSlot: boolean
  searchable: boolean
  multiselect: boolean
  readonly: boolean
  disabled: boolean
  optionValue?: string
  optionLabel?: string
  optionDescription?: string
  template: Template
}

export type Refs = {
  json: HTMLElement
  search?: HTMLInputElement
  input: HTMLInputElement
  slot: HTMLElement
  optionsContainer?: HTMLElement
}
