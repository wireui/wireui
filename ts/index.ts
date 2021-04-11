import utils, { Utilities } from './utils'
import { notify, Notification, makeNotification, NotificationParser } from './notification'

export interface WireUi {
  utils: Utilities
  notify: Notification
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
  makeNotification
}

window.$wireui = wireui

export default wireui
