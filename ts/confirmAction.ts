import { confirmNotification } from './notifications'
import { ConfirmationOptions } from './notifications/options'

export interface ConfirmAction {
  (options: ConfirmationOptions, componentId: string): void
}

export const confirmAction: ConfirmAction = (options, componentId: string): void => {
  confirmNotification(options, componentId)
}
