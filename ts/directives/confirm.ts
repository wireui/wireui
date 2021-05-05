import { confirmAction, NotificationOptions } from '../notification'

const getElements = (component: HTMLElement): HTMLElement[] => {
  return [...component.querySelectorAll('[x-on\\:confirm]')]
    .filter(element => !element.getAttribute('x-on:click')) as HTMLElement[]
}

const initialize = (component: HTMLElement) => {
  const elements = getElements(component)

  elements.forEach(element => {
    const insideAlpineComponent = element.closest('[x-data]')
    const confirmData = element.getAttribute('x-on:confirm')
    const livewireId = element.closest('[wire\\:id]')?.getAttribute('wire:id')

    if (insideAlpineComponent) {
      return element.setAttribute('x-on:click', `$wireui.confirmAction(${confirmData}, '${livewireId}')`)
    }

    element.onclick = () => {
      const options = eval(`(${confirmData})`) as NotificationOptions
      confirmAction(options, livewireId)
    }
  })
}

document.addEventListener('livewire:load', () => initialize(document.body))
document.addEventListener('DOMContentLoaded', () => {
  window.Livewire.hook('message.processed', (_message, component: { el: HTMLElement }) => {
    initialize(component.el)
  })
})
