export type NotificationIcon = 'success' | 'error' | 'info' | 'warning' | 'question'

export interface NotificationAction {
  label: string
  style?: string
  solid?: boolean
  url?: string
  callback?: CallableFunction
  method?: string
  params?: any
}

export interface NotificationEvent {
  url?: string
  method?: string
  params?: any
}

export interface NotificationOptions {
  title?: string
  description?: string
  icon?: NotificationIcon
  iconColor?: string
  img?: string
  closeButton?: boolean
  timeout?: number | boolean
  dense?: boolean
  rightButtons?: boolean
  progressbar?: boolean
  method?: string
  params?: any
  accept?: NotificationAction
  reject?: NotificationAction
  acceptLabel?: string
  rejectLabel?: string
  onClose?: CallableFunction | NotificationEvent
  onDismiss?: CallableFunction | NotificationEvent
  onTimeout?: CallableFunction | NotificationEvent
}

export type Notification = {
  (options: NotificationOptions, componentId?: string | null): void
}

export type CallComponentAction = {
  (componentId: string, method: string, params: any): void
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

const parseActions = (options: NotificationOptions, componentId?: string | null) => {
  const actions = Object.keys(options).filter(key => ['accept', 'reject'].includes(key))

  actions.forEach(actionName => {
    const action = options[actionName] as NotificationAction
    if (typeof action === 'object' && !action.callback && !action.url && componentId) {
      options[actionName].callback = makeCallback(componentId, action.method as string, action.params)
    }

    if (typeof action === 'object' && action.url) {
      options[actionName].callback = () => { window.location.href = action.url as string }
    }
  })
}

const parseEvents = (options: NotificationOptions, componentId?: string | null) => {
  const events = Object.keys(options).filter(key => ['onClose', 'onDismiss', 'onTimeout'].includes(key))

  events.forEach(eventName => {
    const event = options[eventName] as NotificationEvent
    if (typeof event === 'object' && !event.url && componentId) {
      options[eventName] = makeCallback(componentId, event.method as string, event.params)
    }

    if (typeof event === 'object' && event.url) {
      options[eventName] = () => { window.location.href = event.url as string }
    }
  })
}

export type NotificationParser = {
  (options: NotificationOptions, componentId?: string | null): NotificationOptions
}

export const makeNotification: NotificationParser = (options, componentId?) => {
  const notification = Object.assign({
    closeButton: true,
    progressbar: true,
    timeout: 8500
  }, options)

  if (notification.method && componentId) {
    const accept = {
      label: notification.acceptLabel ?? 'Confirm',
      callback: makeCallback(componentId, notification.method, notification.params)
    }

    const reject = Object.assign(
      { label: options.rejectLabel ?? 'Cancel' },
      options.reject ?? {}
    ) as NotificationAction

    if (!reject.callback && reject?.method) {
      reject.callback = makeCallback(componentId, reject.method, reject.params)
    }

    parseEvents(notification, componentId)
    notification.accept = accept
    notification.reject = reject

    return notification
  }

  parseActions(notification, componentId)
  parseEvents(notification, componentId)

  return notification
}

export const notify: Notification = (options, componentId = null): void => {
  const event = new CustomEvent('wireui:notification', { detail: { options, componentId } })
  window.dispatchEvent(event)
}

export default notify
