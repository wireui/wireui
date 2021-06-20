import { EventOptions } from '../notifications/events'
import { Icon } from '../notifications/icons'
import { ActionOptions, ButtonOptions } from './actions'

export type Style = 'center' | 'inline'

export interface Options {
  id?: string
  title?: string
  description?: string
  icon?: Icon | string
  iconColor?: string
  iconBackground?: string
  timeout?: number
  style?: Style
  closeButton?: boolean
  progressbar?: boolean
  close?: ButtonOptions | string
  onClose?: CallableFunction | EventOptions
  onDismiss?: CallableFunction | EventOptions
  onTimeout?: CallableFunction | EventOptions
}

export interface ConfirmationOptions extends Omit<Options, 'close'> {
  method?: string
  params?: any
  accept?: ActionOptions
  reject?: ActionOptions
  acceptLabel?: string
  rejectLabel?: string
}
