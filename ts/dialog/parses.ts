import { ConfirmDialog, Dialog } from '.'
import { parseActions } from './actions'
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
    style: 'center'
  }, options) as Dialog

  if (typeof options.icon === 'string') {
    dialog.icon = parseIcon({
      name: options.icon,
      color: options.iconColor,
      background: options.iconBackground
    })
  }

  const { onClose, onDismiss, onTimeout } = parseEvents(options, componentId)

  return {
    ...dialog,
    onClose,
    onDismiss,
    onTimeout
  }
}

export const parseConfirmation: ParseConfirmation = (options, componentId?): ConfirmDialog => {
  const dialog = parseDialog(options, componentId)

  const { accept, reject } = parseActions(options, componentId)

  return {
    ...dialog,
    accept,
    reject
  }
}
