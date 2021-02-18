import { SweetAlertResult } from 'sweetalert2'
import {
  notify, Notify, modal, Modal, confirmation, Confirmation
} from './sweetAlert'

export interface WireUi {
  notify (options: Notify): Promise<SweetAlertResult<any>>
  modal (options: Modal): Promise<SweetAlertResult<any>>
  confirmation (options: Confirmation): Promise<SweetAlertResult<any>>
}

declare global {
  interface Window {
    $wireui: WireUi
  }
}

const wireui = {
  notify,
  modal,
  confirmation
}

window.$wireui = wireui

export default wireui
