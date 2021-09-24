import { notify, confirmNotification, Notify, Confirm } from './notifications'
import { confirmAction, ConfirmAction } from './confirmAction'
import { showDialog, showConfirmDialog, ShowConfirmDialog, ShowDialog } from './dialog'
import { WireUiHooks } from './hooks'
import { start, Start } from './components'
import './directives/confirm'
import './global'

export interface WireUi {
  notify: Notify
  confirmNotification: Confirm
  confirmAction: ConfirmAction
  dialog: ShowDialog
  confirmDialog: ShowConfirmDialog
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
  notify,
  confirmNotification,
  confirmAction,
  dialog: showDialog,
  confirmDialog: showConfirmDialog,
  start
}

window.$wireui = wireui
document.addEventListener('DOMContentLoaded', () => window.Wireui.dispatchHook('load'))

export default wireui
