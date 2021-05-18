import utils, { Utilities } from './utils'
import { notify, confirmAction, Notification, makeNotification, NotificationParser } from './notification'
import './directives/confirm'

export interface WireUi {
  utils: Utilities
  notify: Notification
  confirmAction: Notification
  makeNotification: NotificationParser
}

export interface WireUiHooks {
  hook (hook: string, callback: CallableFunction): void,
  dispatchHook (hook: string): void
}

declare global {
  interface Window {
    $wireui: WireUi
    Wireui: WireUiHooks
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
window.Wireui.dispatchHook('load')

export default wireui
