import kebabCase from 'lodash.kebabcase'

window.$openModal = name => {
  return window.dispatchEvent(new Event(`open-wireui-modal:${kebabCase(name)}`))
}

window.$closeModal = name => {
  return window.dispatchEvent(new Event(`close-wireui-modal:${kebabCase(name)}`))
}
