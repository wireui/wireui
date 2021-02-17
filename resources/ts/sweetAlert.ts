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

const notify = (notify: Notify): Promise<SweetAlertResult<any>> => {
  const swal = Swal.mixin({
    toast: true,
    position: notify.position ?? 'top-end',
    showCloseButton: true,
    timerProgressBar: notify.progressBar ?? false,
    timer: notify.timeout || 8000,
    didOpen: toast => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  return new Promise(resolve => {
    swal.fire({
      icon: notify.icon,
      title: notify.title
    }).then(value => {
      return resolve(value)
    })
  })
}

const modal = (modal: Modal): Promise<SweetAlertResult<any>> => {
  const swal = Swal.fire({
    icon: modal.icon,
    title: modal.title,
    html: modal.html,
    confirmButtonText: modal.confirmText ?? 'Ok'
  })

  return new Promise(resolve => {
    swal.then(value => {
      return resolve(value)
    })
  })
}

export { notify, modal }
export default { notify, modal }
