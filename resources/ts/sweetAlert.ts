import Swal, { SweetAlertIcon, SweetAlertPosition, SweetAlertResult } from 'sweetalert2'

export interface Notify {
  timeout?: number
  progressBar?: boolean
  position?: SweetAlertPosition
  icon?: SweetAlertIcon
  title: string
}

export interface Modal {
  icon?: SweetAlertIcon
  title?: string
  html?: string
  confirmText?: string
}

export interface Confirmation {
  title?: string
  html?: string
  confirmText?: string
  cancelText?: string
  confirmColor: string
  cancelColor?: string
  reverseButtons?: boolean
}

const notify = (options: Notify): Promise<SweetAlertResult<any>> => {
  return Swal.mixin({
    toast: true,
    position: options.position ?? 'top-end',
    showConfirmButton: false,
    showCloseButton: true,
    timerProgressBar: options.progressBar ?? false,
    timer: options.timeout || 8000,
    didOpen: toast => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  }).fire({
    icon: options.icon,
    title: options.title
  })
}

const modal = (options: Modal): Promise<SweetAlertResult<any>> => {
  return Swal.fire({
    icon: options.icon,
    title: options.title,
    html: options.html,
    confirmButtonText: options.confirmText ?? 'Ok'
  })
}

const confirmation = (options: Confirmation): Promise<SweetAlertResult<any>> => {
  return Swal.fire({
    icon: 'question',
    title: options.title ?? 'Are you sure?',
    html: options.html ?? 'Do you want to confirm this action?',
    showCancelButton: true,
    confirmButtonText: options.confirmText ?? 'Accept',
    cancelButtonText: options.cancelText ?? 'Reject',
    confirmButtonColor: options.confirmColor ?? '#10B981',
    cancelButtonColor: options.cancelColor ?? '#EF4444',
    reverseButtons: options.reverseButtons ?? true
  })
}

export { notify, modal, confirmation }
export default { notify, modal, confirmation }
