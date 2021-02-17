import { SweetAlertResult } from 'sweetalert2'
import { notify, Notify, modal, Modal } from './sweetAlert'

export interface WireUi {
  notify (notify: Notify): Promise<SweetAlertResult<any>>
  modal (modal: Modal): Promise<SweetAlertResult<any>>
}

declare global {
  interface Window {
    $wireui: WireUi
  }
}

const wireui = {
  notify,
  modal
}

window.$wireui = wireui

export default wireui
