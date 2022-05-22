import kebabCase from 'lodash.kebabcase'

window.$openWireModal = name => {
  return window.dispatchEvent(new Event(`open-wire-modal:${kebabCase(name)}`))
}
