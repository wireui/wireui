import { confirmation, Confirmation } from './sweetAlert'

export interface ConfirmAction extends Confirmation {
  method: string
  params: any
}

export interface LivewireActions {
  confirmAction (options: ConfirmAction, componentId: string): void
}

const confirmAction = (options: ConfirmAction, componentId: string): void => {
  confirmation(options).then(status => {
    if (!status.isConfirmed || !status.value) return

    const component = window.Livewire.find(componentId)
    Array.isArray(options.params)
      ? component.call(options.method, ...options.params)
      : component.call(options.method, options.params)
  })
}

export { confirmAction }
export default { confirmAction }
