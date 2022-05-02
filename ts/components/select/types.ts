import { Entangle } from '../alpine'
import { Template, TemplateName } from './templates'

export type Option = {
  value: any
  label: string
  template?: TemplateName
  html?: string
  disabled?: boolean
  readonly?: boolean
  [index: string]: any
}

export type TemplateConfig = {
  name: TemplateName,
  config: object
}

export type Options = Option[]

export type InitOptions = {
  hasSlot: boolean
  searchable: boolean
  multiselect: boolean
  readonly: boolean
  disabled: boolean
  placeholder: string
  template?: TemplateConfig
  wireModel?: Entangle
}

export type Config = {
  hasSlot: boolean
  searchable: boolean
  multiselect: boolean
  readonly: boolean
  disabled: boolean
  template: Template
}

export type Refs = {
  json: HTMLElement
  search: HTMLInputElement
  input: HTMLInputElement
  slot: HTMLElement
}
