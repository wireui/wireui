import { notify, confirmNotification, Notify, Confirm } from './alpine/components/notifications'
import { showDialog, showConfirmDialog, ShowConfirmDialog, ShowDialog } from './alpine/components/dialog'
import { dataGet, DataGet } from './utils/dataGet'
import { Alpine } from '@/alpine/components/alpine'
import { WireUiConfig } from './config'
import { Livewire } from '@/livewire'
import '@/alpine'

declare global {
  interface Window {
    $wireui: WireUi
    Wireui: WireUiConfig
    Livewire: Livewire
    Alpine: Alpine
    $openModal: CallableFunction
    $closeModal: CallableFunction
  }
}

export interface WireUi {
  notify: Notify
  confirmNotification: Confirm
  confirmAction: ShowConfirmDialog
  dialog: ShowDialog
  confirmDialog: ShowConfirmDialog
  dataGet: DataGet
}

const wireui: WireUi = {
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
