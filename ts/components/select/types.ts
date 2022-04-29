import { Entangle } from '../alpine'
import { Template } from './templates'

export type Option = {
  value: any
  label: string
  template?: Template
  disabled?: boolean
  readonly?: boolean
}

export type Options = Option[]

export type InitOptions = {
  searchable: boolean
  multiselect: boolean
  readonly: boolean
  disabled: boolean
  placeholder: string
  optionTemplate?: Template
  wireModel?: Entangle
}

export type Config = {
  searchable: boolean
  multiselect: boolean
  readonly: boolean
  disabled: boolean
  optionTemplate: Template
}

export type Refs = {
  json: HTMLElement
  search: HTMLInputElement
  input: HTMLInputElement
}
