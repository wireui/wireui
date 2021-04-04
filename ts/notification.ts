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
  accept?: NotificationAction
  reject?: NotificationAction
  onClose?: CallableFunction
  onDismiss?: CallableFunction
  onTimeout?: CallableFunction
}

export type Notification = {
  (options: NotificationOptions): void
}

export const notify: Notification = (options: NotificationOptions): void => {
  const defaultOptions = { closeButton: true, progressbar: true }
  const notification = Object.assign(defaultOptions, options)
  const event = new CustomEvent('wireui:notification', { detail: notification })
  window.dispatchEvent(event)
}

export default notify
