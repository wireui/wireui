import baseTemplate from './baseTemplate'
import { Option } from '../types'
import { InitTemplate } from '.'

export const template: InitTemplate = () => ({
  render (option: Option) {
    return baseTemplate(`<span>${option.label}</span>`)
  }
})

export default template
