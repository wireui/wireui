import utils, { Utilities } from './utils'
import { notify, confirmAction, Notification, makeNotification, NotificationParser } from './notification'
import './directives/confirm'

export interface WireUi {
  utils: Utilities
  notify: Notification
  confirmAction: Notification
  makeNotification: NotificationParser
}

declare global {
  interface Window {
    $wireui: WireUi
    Livewire: any
  }
}

const wireui = {
  utils,
  notify,
  confirmAction,
  makeNotification
}

window.$wireui = wireui

export default wireui
