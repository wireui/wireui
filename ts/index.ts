import utils, { Utilities } from './utils'
import { notifications, notify, confirmNotification, Notifications, Notify, Confirm } from './notifications'
import { confirmAction, ConfirmAction } from './confirmAction'
import { dialogs, showDialog, showConfirmDialog, Dialogs, ShowConfirmDialog, ShowDialog } from './dialog'
import { WireUiHooks } from './hooks'
import './directives/confirm'
import './global'

export interface WireUi {
  utils: Utilities
  notify: Notify
  confirmNotification: Confirm
  confirmAction: ConfirmAction
  notifications: Notifications
  showDialog: ShowDialog
  showConfirmDialog: ShowConfirmDialog
  dialogs: Dialogs
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
  showDialog,
  showConfirmDialog,
  dialogs
}

window.$wireui = wireui

export default wireui
