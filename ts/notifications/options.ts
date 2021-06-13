import { ActionOptions } from './actions'
import { EventOptions } from './events'

export interface Options {
  title?: string
  description?: string
  icon?: string
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
  params?: any
  accept?: ActionOptions
  reject?: ActionOptions
  acceptLabel?: string
  rejectLabel?: string
}

export const defaultOptions = {
  closeButton: true,
  progressbar: true,
  timeout: 8500
}
