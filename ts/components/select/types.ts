export type Option = {
  value: any
  label: string
  component?: string
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
}

export type Config = {
  searchable: boolean
  multiselect: boolean
  readonly: boolean
  disabled: boolean
}

export type Refs = {
  json: HTMLElement
  search: HTMLInputElement
  input: HTMLInputElement
}
