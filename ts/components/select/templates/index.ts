import { Option } from '../types'
import option from './option'
import userOption from './userOption'

export interface Template {
  config?: any
  render: (option: Option) => string
  renderSelected?: (option: Option) => string
}

export interface InitTemplate {
  (options?: any): Template
}

export type Templates = {
  'default': InitTemplate
  'user-option': InitTemplate
}

export type TemplateName = keyof Templates

export const templates: Templates = {
  'default': option,
  'user-option': userOption
}

export default templates
