import { showConfirmDialog } from '@/dialog'
import { ConfirmationOptions } from '@/dialog/options'

const getElements = (component: HTMLElement): HTMLElement[] => {
  return [...component.querySelectorAll('[x-on\\:confirm]')]
    .filter(element => !element.getAttribute('x-on:click')) as HTMLElement[]
}

const initializeElement = (element: HTMLElement) => {
  if (!element.hasAttribute('x-on:confirm')) return
  if (element.hasAttribute('x-on:click')) return

  const insideAlpineComponent = element.closest('[x-data]')
  const confirmData = element.getAttribute('x-on:confirm')
  const componentId = element.closest('[wire\\:id]')?.getAttribute('wire:id')

  if (insideAlpineComponent) {
    return element.setAttribute('x-on:click', `$wireui.confirmAction(${confirmData}, '${componentId}')`)
  }

  element.onclick = () => {
    const options = eval(`(${confirmData})`) as ConfirmationOptions
    showConfirmDialog(options, componentId)
  }
}

const initialize = (component: HTMLElement) => {
  getElements(component).forEach(element => initializeElement(element))
}

document.addEventListener('livewire:init', () => {
  window.Livewire.hook('element.init', ({ el }) => {
    initializeElement(el)
  })

  window.Livewire.hook('morph.added',  ({ el }) => {
    initializeElement(el)
  })

  window.Livewire.hook('component.init', ({ component }) => {
    queueMicrotask(() => initialize(component.el))
  })
})

document.addEventListener('DOMContentLoaded', () => {
  initialize(document.body)
})
