import { showConfirmDialog } from './dialog'
import { ConfirmationOptions } from './dialog/options'

export interface ConfirmAction {
  (options: ConfirmationOptions, componentId: string): void
}

export const confirmAction: ConfirmAction = (options, componentId: string): void => {
  showConfirmDialog(options, componentId)
}
