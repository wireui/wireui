import { notify, NotificationOptions, NotificationAction } from './notification'

export interface NotificationEvent {
  url?: string
  method?: string
  params?: any
}

export interface ConfirmAction extends NotificationAction {
  method?: string
  params?: any
}

export interface ConfirmActionOptions
  extends Omit<NotificationOptions, 'onClose' | 'onDismiss' | 'onTimeout'> {
  method?: string
  params?: any
  acceptLabel?: string
  rejectLabel?: string
  onClose?: CallableFunction | NotificationEvent
  onDismiss?: CallableFunction | NotificationEvent
  onTimeout?: CallableFunction | NotificationEvent
}

export type CallComponentAction = {
  (componentId: string, method: string, params: any): void
}

export interface LivewireActions {
  makeNotification (options: ConfirmActionOptions, componentId: string): NotificationOptions
  confirmAction (options: ConfirmActionOptions, componentId: string): void
  call: CallComponentAction
}

export const callComponentAction: CallComponentAction = (componentId, method, params = null) => {
  const component = window.Livewire.find(componentId)

  params
    ? Array.isArray(params)
      ? component?.call(method, ...params)
      : component?.call(method, params)
    : component?.call(method)
}

const makeCallback = (componentId: string, method: string, params: any = null): CallableFunction => {
  return () => callComponentAction(componentId, method, params)
}

export const makeNotification = (options: ConfirmActionOptions, componentId: string): NotificationOptions => {
  const notification = Object.assign({
    title: 'You Sure?',
    description: 'Do you want to confirm?',
    icon: 'question'
  }, options)

  if (!options.reject) {
    notification.reject = { label: options.rejectLabel ?? 'Cancel' }
  }

  if (options.method) {
    notification.accept = {
      label: options.acceptLabel ?? 'Confirm',
      callback: makeCallback(componentId, options.method, options.params)
    }

    return notification as NotificationOptions
  }

  const keys = Object.keys(options)
  const actions = keys.filter(key => ['accept', 'reject'].includes(key))
  const events = keys.filter(key => ['onClose', 'onDismiss', 'onTimeout'].includes(key))

  actions.forEach(action => {
    if (typeof notification[action] === 'object') {
      notification[action].url
        ? notification[action].callback = () => { window.location.href = notification[action].url }
        : notification[action].callback = makeCallback(componentId, options[action].method, options[action].params)
    }
  })

  events.forEach(event => {
    if (typeof notification[event] === 'object') {
      notification[event] = notification[event].url
        ? notification[event] = () => { window.location.href = notification[event].url }
        : notification[event] = makeCallback(componentId, options[event].method, options[event].params)
    }
  })

  return notification as NotificationOptions
}

export const confirmAction = (options: ConfirmActionOptions, componentId: string): void => {
  const notification = makeNotification(options, componentId)

  notify(notification)
}

export default {
  makeNotification,
  confirmAction,
  call: callComponentAction
}
