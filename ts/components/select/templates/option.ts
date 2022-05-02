import baseTemplate from './baseTemplate'
import { Option } from '../types'
import { InitTemplate, Template } from '.'

export interface DefaultTemplate extends Template {
  renderSelected: (option: Option) => string
}

export const template: InitTemplate = (): DefaultTemplate => ({
  render (option: Option) {
    return baseTemplate(this.renderSelected(option))
  },
  renderSelected (option) {
    return `<span>${option.label}</span>`
  }
})

export default template
