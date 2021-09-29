import { notify, confirmNotification, Notify, Confirm } from './notifications'
import { confirmAction, ConfirmAction } from './confirmAction'
import { showDialog, showConfirmDialog, ShowConfirmDialog, ShowDialog } from './dialog'
import { dataGet, DataGet } from './utils/dataGet'
import { Alpine } from './components/alpine'
import { WireUiHooks } from './hooks'
import './directives/confirm'
import './browserSupport'
import './components'
import './global'

export interface WireUi {
  notify: Notify
  confirmNotification: Confirm
  confirmAction: ConfirmAction
  dialog: ShowDialog
  confirmDialog: ShowConfirmDialog
  dataGet: DataGet
}

declare global {
  interface Window {
    $wireui: WireUi
    Wireui: WireUiHooks
    Livewire: any
    Alpine: Alpine
    $openModal: CallableFunction
  }
}

const wireui = {
  notify,
  confirmNotification,
  confirmAction,
  dialog: showDialog,
  confirmDialog: showConfirmDialog,
  dataGet
}

window.$wireui = wireui
document.addEventListener('DOMContentLoaded', () => window.Wireui.dispatchHook('load'))

export default wireui
