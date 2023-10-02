import { Icon, icons } from './icons'
import { Action } from './actions'
import { ConfirmationOptions, Options } from './options'
import { parseConfirmation, parseNotification, ParseConfirmation, ParseNotification } from './parses'
import { timer, Timer } from './timer'

export interface Notification {
  title?: string
  description?: string
  icon?: Icon
  img?: string
  closeButton?: boolean
  timeout?: number
  dense?: boolean
  rightButtons?: boolean
  progressbar?: boolean
  onClose: CallableFunction
  onDismiss: CallableFunction
  onTimeout: CallableFunction
}

export interface ConfirmNotification extends Notification {
  accept: Action
  reject: Action
}

export interface Notifications {
  parseNotification: ParseNotification
  parseConfirmation: ParseConfirmation
  timer: Timer
}

export interface Notify {
  (options: Options, componentId?: string): void
}

export interface Confirm {
  (options: ConfirmationOptions, componentId?): void
}

export const notify: Notify = (options, componentId?): void => {
  const event = new CustomEvent('wireui:notification', { detail: { options, componentId } })
  window.dispatchEvent(event)
}

export const confirmNotification: Confirm = (options, componentId?): void => {
  options = Object.assign({
    icon: icons['warning'],
    title: 'Are you sure?',
    description: 'You won\'t be able to revert this!'
  }, options)

  const event = new CustomEvent('wireui:confirm-notification', { detail: { options, componentId } })
  window.dispatchEvent(event)
}

export const notifications: Notifications = {
  parseNotification,
  parseConfirmation,
  timer
}
