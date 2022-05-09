import baseTemplate from './baseTemplate'
import { Option } from '../types'
import { InitTemplate, Template } from '.'

export interface DefaultTemplate extends Template {
  renderSelected: (option: Option) => string
}

export const template: InitTemplate = (): DefaultTemplate => ({
  render (option: Option) {
    if (option.description) {
      return baseTemplate(`
      <div>
        ${option.label}
        <span class="text-xs opacity-75">
          <br/> ${option.description}
        </span>
      </div>
      `)
    }

    return baseTemplate(this.renderSelected(option))
  },
  renderSelected (option) {
    return `<span>${option.label}</span>`
  }
})

export default template
