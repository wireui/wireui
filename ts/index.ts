import utils, { Utilities } from './utils'
import { notifications, notify, Notifications, Notify } from './notifications'
import { confirmAction, ConfirmAction } from './confirmAction'
import { WireUiHooks } from './hooks'
import './directives/confirm'
import './global'

export interface WireUi {
  utils: Utilities
  notify: Notify
  confirmAction: ConfirmAction
  notifications: Notifications
}

declare global {
  interface Window {
    $wireui: WireUi
    Wireui: WireUiHooks
    Livewire: any
    $openModal: CallableFunction
  }
}

const wireui = {
  utils,
  notify,
  confirmAction,
  notifications
}

window.$wireui = wireui

export default wireui
