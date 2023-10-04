import kebabCase from '@/utils/kebabCase'
import './directives/confirm'
import './store'
import './magic'
import './directives'
import './components'

window.$openModal = (name: string) => {
  return window.dispatchEvent(new Event(`open-wireui-modal:${kebabCase(name)}`))
}

window.$closeModal = (name: string) => {
  return window.dispatchEvent(new Event(`close-wireui-modal:${kebabCase(name)}`))
}
