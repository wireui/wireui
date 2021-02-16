import Swal, { SweetAlertIcon, SweetAlertPosition } from 'sweetalert2'

export interface Notify {
    timeout?: number
    progressBar: boolean
    position: SweetAlertPosition
    icon: SweetAlertIcon
    title: string
}

const notify = (notify: Notify): void => {
    Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timerProgressBar: notify.progressBar ?? false,
        timer: notify.timeout || 8000,
        didOpen: toast => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    }).fire({
        icon: notify.icon,
        title: notify.title,
    })
}

export { notify }
export default { notify }
