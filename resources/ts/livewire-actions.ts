import { confirmation, ConfirmationOptions } from './notifier'

export interface ConfirmActionOptions extends ConfirmationOptions {
  method: string
  params: any
}

export interface LivewireActions {
  confirmAction (options: ConfirmActionOptions, componentId: string): void
}

export const confirmAction = (options: ConfirmActionOptions, componentId: string): void => {
  confirmation(options).then(status => {
    if (!status.isConfirmed || !status.value) return

    const component = window.Livewire.find(componentId)
    Array.isArray(options.params)
      ? component.call(options.method, ...options.params)
      : component.call(options.method, options.params)
  })
}

export default { confirmAction }
