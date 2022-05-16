import { EventOptions } from '../notifications/events'
import { Icon } from '../notifications/icons'
import { Pausable } from '../utils/timeout'
import { Action, ButtonOptions } from './actions'
import { ConfirmationOptions, Options, Style } from './options'
import { parseDialog, parseConfirmation, ParseDialog, ParseConfirmation } from './parses'

export interface DialogOptions {
  title?: string
  description?: string
  icon?: Icon | string
  timeout: number
  style: Style
  close?: ButtonOptions | string
  closeButton: boolean
  progressbar: boolean
  onClose: CallableFunction | EventOptions
  onDismiss: CallableFunction | EventOptions
  onTimeout: CallableFunction | EventOptions
}

export interface ConfirmDialogOptions extends DialogOptions {
  accept: Action
  reject: Action
}

export interface Dialog extends DialogOptions {
  icon?: Icon
  close: ButtonOptions
  onClose: CallableFunction
  onDismiss: CallableFunction
  onTimeout: CallableFunction
  timer?: Pausable
}

export interface ConfirmDialog extends Dialog {
  accept: Action
  reject: Action
}

export interface ShowDialog {
  (options: Options, componentId?: string): void
}

export interface ShowConfirmDialog {
  (options: ConfirmationOptions, componentId?: string | null): void
}

export interface Dialogs {
  parseDialog: ParseDialog
  parseConfirmation: ParseConfirmation
}

const makeEventName = (id): string => {
  const event = 'dialog'

  if (id) { return `${event}:${id}` }

  return event
}

export const showDialog: ShowDialog = (options, componentId?): void => {
  const event = new CustomEvent(`wireui:${makeEventName(options.id)}`, { detail: { options, componentId } })
  window.dispatchEvent(event)
}

export const showConfirmDialog: ShowConfirmDialog = (options, componentId?): void => {
  if (!options.icon) { options.icon = 'question' }
  const event = new CustomEvent(`wireui:confirm-${makeEventName(options.id)}`, { detail: { options, componentId } })
  window.dispatchEvent(event)
}

export const dialogs: Dialogs = {
  parseDialog,
  parseConfirmation
}
