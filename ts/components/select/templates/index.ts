import option from './option'
import userOption from './userOption'

export type Templates = {
  'default': string
  'user-option': string
}

export type Template = keyof Templates

export const templates: Templates = {
  'default': option,
  'user-option': userOption
}

export default templates
