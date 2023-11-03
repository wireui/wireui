import './global'
import './components'
import './alpine/magic'
import './alpine/store'
import './browserSupport'
import './alpine/directives'
import './directives/confirm'
import { WireUiHooks } from './hooks'
import { Alpine } from './components/alpine'
import { dataGet, DataGet } from './utils/dataGet'
import { Confirm, confirmNotification, Notify, notify } from './notifications'
import { showConfirmDialog, ShowConfirmDialog, showDialog, ShowDialog } from './dialog'

export interface WireUi {
  notify: Notify
  confirmNotification: Confirm
  confirmAction: ShowConfirmDialog
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
    $closeModal: CallableFunction
  }
}

const wireui = {
  notify,
  confirmNotification,
  confirmAction: showConfirmDialog,
  dialog: showDialog,
  confirmDialog: showConfirmDialog,
  dataGet
}

window.$wireui = wireui
document.addEventListener('DOMContentLoaded', () => window.Wireui.dispatchHook('load'))

export default wireui
