import { ConfirmDialogOptions, ConfirmDialog, Dialog, DialogOptions } from './index'
import { iconsMap, parseActions } from './actions'
import { parseEvents } from './events'
import { parseIcon } from './icons'
import { ConfirmationOptions, Options } from './options'

export interface ParseDialog {
  (options: Options, componentId?: string): Dialog
}

export interface ParseConfirmation {
  (options: ConfirmationOptions, componentId?: string): ConfirmDialog
}

export const parseDialog: ParseDialog = (options, componentId?): Dialog => {
  const dialog = Object.assign({
    closeButton: true,
    progressbar: true,
    style: 'center',
    close: 'OK'
  }, options) as DialogOptions

  if (typeof dialog.icon === 'string') {
    dialog.icon = parseIcon({
      name: dialog.icon,
      color: options.iconColor,
      background: options.iconBackground
    })
  }

  if (typeof dialog.close === 'string') {
    dialog.close = { label: dialog.close }
  }

  if (
    typeof dialog.close === 'object'
    && !dialog.close.color
    && typeof options.icon === 'string'
    && ['success', 'error', 'info', 'warning', 'question'].includes(options.icon)
  ) {
    dialog.close.color = iconsMap[options.icon] ?? options.icon
  }

  const { onClose, onDismiss, onTimeout } = parseEvents(options, componentId)

  return {
    ...dialog,
    onClose,
    onDismiss,
    onTimeout
  } as Dialog
}

export const parseConfirmation: ParseConfirmation = (options, componentId?): ConfirmDialog => {
  options = Object.assign({ style: 'inline' }, options) as ConfirmDialogOptions

  const dialog = parseDialog(options, componentId)

  const { accept, reject } = parseActions(options, componentId)

  return {
    ...dialog,
    accept,
    reject
  }
}
