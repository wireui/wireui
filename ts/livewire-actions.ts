import { notify, NotificationOptions, NotificationAction } from './notification'

export interface ConfirmActionOptions extends NotificationOptions {
  method?: string
  params?: any
}
export interface ConfirmationEvent {
  method: string
  params: any
}

export type CallComponentAction = {
  (componentId: string, method: string, params: any): void
}

export interface LivewireActions {
  makeNotification (options: ConfirmActionOptions, componentId: string): NotificationOptions
  confirmAction (options: ConfirmActionOptions, componentId: string): void
  call: CallComponentAction
}

const makeCallback = (options: ConfirmationEvent, componentId: string): CallableFunction => {
  return () => callComponentAction(componentId, options.method, options.params)
}

export const makeNotification = (options: ConfirmActionOptions, componentId: string): NotificationOptions => {
  const notification = Object.assign({}, options)
  const keys = Object.keys(notification)
  const actions = keys.filter(key => ['accept', 'reject'].includes(key))
  const events = keys.filter(key => ['onClose', 'onDismiss', 'onTimeout'].includes(key))

  actions.forEach(action => notification[action].callback = makeCallback(notification[action], componentId))
  events.forEach(event => notification[event] = makeCallback(notification[event], componentId))

  if (!notification.accept) {
    notification.accept = {
      label: 'Confirm',
      callback: makeCallback(notification as ConfirmationEvent, componentId)
    }
    notification.reject = { label: 'Cancel' }
  }

  return notification
}

export const confirmAction = (options: ConfirmActionOptions, componentId: string): void => {
  const notification = Object.assign({
    title: 'You Sure?',
    description: 'Do you want to confirm?',
    icon: 'question',
  }, options)

  if (notification.method) {
    notification.accept = {
      label: 'Confirm',
      callback: makeCallback(notification as ConfirmationEvent, componentId)
    }
    notification.reject = { label: 'Cancel' }
  }

  notify(notification)
}

export const callComponentAction: CallComponentAction = (componentId, method, params) => {
  const component = window.Livewire.find(componentId)
  Array.isArray(params)
    ? component?.call(method, ...params)
    : component?.call(method, params)
}

export default {
  makeNotification,
  confirmAction,
  call: callComponentAction
}
