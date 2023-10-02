import { notify, confirmNotification, Notify, Confirm } from './alpine/components/notifications'
import { showDialog, showConfirmDialog, ShowConfirmDialog, ShowDialog } from './alpine/components/dialog'
import { dataGet, DataGet } from './utils/dataGet'
import { Alpine } from '@/alpine/components/alpine'
import { WireUiHooks } from './hooks'
import './alpine/directives/confirm'
import './alpine/store'
import './alpine/magic'
import './alpine/directives'
import './alpine/components'

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
