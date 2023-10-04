import { showConfirmDialog } from '../components/dialog'
import { ConfirmationOptions } from '@/alpine/components/dialog/options'

const getElements = (component: HTMLElement): HTMLElement[] => {
  return [...component.querySelectorAll('[x-on\\:confirm]')]
    .filter(element => !element.getAttribute('x-on:click')) as HTMLElement[]
}

const initialize = (component: HTMLElement) => {
  const elements = getElements(component)

  elements.forEach(element => {
    const confirmData = element.getAttribute('x-on:confirm')
    const rootAlpineElement = element.closest('[x-data]')
    const livewireId = element.closest('[wire\\:id]')?.getAttribute('wire:id')

    if (rootAlpineElement) {
      return element.setAttribute('x-on:click', `$wireui.confirmAction(${confirmData}, '${livewireId}')`)
    }

    element.onclick = () => {
      const options = eval(`(${confirmData})`) as ConfirmationOptions
      showConfirmDialog(options, livewireId)
    }
  })
}

document.addEventListener('livewire:init', () => {
  window.Livewire.hook('commit', ({ component, succeed }) => {
    succeed(() => {
      queueMicrotask(() => initialize(component.el))
    })
  })
})

document.addEventListener('DOMContentLoaded', () => {
  initialize(document.body)
})
