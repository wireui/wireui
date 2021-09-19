import utils, { Utilities } from './utils'
import { notifications, notify, confirmNotification, Notifications, Notify, Confirm } from './notifications'
import { confirmAction, ConfirmAction } from './confirmAction'
import { dialogs, showDialog, showConfirmDialog, Dialogs, ShowConfirmDialog, ShowDialog } from './dialog'
import { WireUiHooks } from './hooks'
import start, { Start } from './components'
import './directives/confirm'
import './global'

export interface WireUi {
  utils: Utilities
  notify: Notify
  confirmNotification: Confirm
  confirmAction: ConfirmAction
  notifications: Notifications
  dialog: ShowDialog
  confirmDialog: ShowConfirmDialog
  dialogs: Dialogs
  start: Start
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
  confirmNotification,
  confirmAction,
  notifications,
  dialog: showDialog,
  confirmDialog: showConfirmDialog,
  dialogs,
  start
}

window.$wireui = wireui
document.addEventListener('DOMContentLoaded', () => window.Wireui.dispatchHook('load'))

export default wireui
