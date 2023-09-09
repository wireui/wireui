import baseTemplate from './baseTemplate'
import { Option } from '../types'
import { Template, InitTemplate } from '.'

export interface UserTemplate extends Omit<Template, 'config'> {
  config: { src?: string }
  renderSelected: (option: Option) => string
  getSrc (option: Option): string | undefined
}

export interface UserInitTemplate extends InitTemplate {
  (options): UserTemplate
}

export const template: UserInitTemplate = (config): UserTemplate => ({
  config,
  render (option: Option) {
    return baseTemplate(`
      <div class="flex items-center gap-x-3">
        <img src="${this.getSrc(option)}" class="shrink-0 h-6 w-6 object-cover rounded-full">

        <div :class="{ 'text-sm': Boolean(option.description) }">
          ${option.label}

          <span x-show="option.description" class="text-xs opacity-70">
            <br/> ${option.description}
          </span>
        </div>
      </div>
    `)
  },
  renderSelected (option) {
    return `
      <div class="flex items-center gap-x-3">
        <img src="${this.getSrc(option)}" class="shrink-0 h-6 w-6 object-cover rounded-full">

        <span>${option.label}</span>
      </div>
    `
  },
  getSrc (option) {
    if (this.config.src) {
      return option[this.config.src]
    }

    return option.src
  }
})

export default template
