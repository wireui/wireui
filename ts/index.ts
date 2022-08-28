import { notify, confirmNotification, Notify, Confirm } from './notifications'
import { showDialog, showConfirmDialog, ShowConfirmDialog, ShowDialog } from './dialog'
import { dataGet, DataGet } from './utils/dataGet'
import { Alpine } from './components/alpine'
import { WireUiHooks } from './hooks'
import './directives/confirm'
import './browserSupport'
import './alpine/store'
import './alpine/magic'
import './alpine/directives'
import './components'
import './global'

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
