import { ActionOptions } from './actions'
import { EventOptions } from './events'
import { Icon } from './icons'

export interface Options {
  title?: string
  description?: string
  icon?: Icon | string
  iconColor?: string
  img?: string
  closeButton?: boolean
  timeout?: number | boolean
  dense?: boolean
  rightButtons?: boolean
  progressbar?: boolean
  onClose?: CallableFunction | EventOptions
  onDismiss?: CallableFunction | EventOptions
  onTimeout?: CallableFunction | EventOptions
}

export interface ConfirmationOptions extends Options {
  method?: string
  dispatch?: string
  to?: string
  params?: any
  accept?: ActionOptions
  reject?: ActionOptions
  acceptLabel?: string
  rejectLabel?: string
}
