import baseTemplate from './baseTemplate'
import { Option } from '../types'
import { Template, InitTemplate } from '.'

export interface UserTemplate extends Template {
  getSrc (option: Option): string | undefined
}

export interface UserInitTemplate extends InitTemplate {
  (options): UserTemplate
}

export const template: UserInitTemplate = (config: { src?: string }): UserTemplate => ({
  config,
  render (option: Option) {
    return baseTemplate(`
      <div class="flex items-center gap-x-3">
          <img src="${this.getSrc(option)}" class="shrink-0 h-6 w-6 rounded-full">

          <span>${option.label}</span>
      </div>
    `)
  },
  getSrc (option) {
    if (this.config.src) {
      return option[this.config.src]
    }

    return option.src
  }
})

export default template
