import { SweetAlertResult } from 'sweetalert2'
import Livewire, { LivewireActions } from './livewire'
import {
  notify, Notify, modal, Modal, confirmation, Confirmation
} from './sweetAlert'

export interface WireUi {
  notify (options: Notify): Promise<SweetAlertResult<any>>
  modal (options: Modal): Promise<SweetAlertResult<any>>
  confirmation (options: Confirmation): Promise<SweetAlertResult<any>>
  livewire: LivewireActions
}

declare global {
  interface Window {
    $wireui: WireUi
    Livewire: any
  }
}

const wireui = {
  notify,
  modal,
  confirmation,
  livewire: Livewire
}

window.$wireui = wireui

export default wireui
