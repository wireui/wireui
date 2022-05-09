import baseTemplate from './baseTemplate'
import { Option } from '../types'
import { InitTemplate, Template } from '.'

export interface DefaultTemplate extends Template {
  renderSelected: (option: Option) => string
}

export const template: InitTemplate = (): DefaultTemplate => ({
  render (option: Option) {
    return baseTemplate(`
      <div>
        ${option.label}

        <span x-show="option.description" class="text-xs opacity-70">
            <br/> ${option.description}
          </span>
      </div>
    `)
  },
  renderSelected (option) {
    return `<span>${option.label}</span>`
  }
})

export default template
