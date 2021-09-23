import { Alpine } from './alpine'
import dropdown from './dropdown'
import modal from './modal'
import dialog from './dialog'
import notifications from './notifications'
import maskable from './inputs/maskable'
import currency from './inputs/currency'
import select from './select'
import timePicker from './timePicker'

export interface Start {
  (Alpine: Alpine): void
}

const start: Start = (Alpine: Alpine) => {
  Alpine.data('wireui_dropdown', dropdown)
  Alpine.data('wireui_modal', modal)
  Alpine.data('wireui_dialog', dialog)
  Alpine.data('wireui_notifications', notifications)
  Alpine.data('wireui_inputs_maskable', maskable)
  Alpine.data('wireui_inputs_currency', currency)
  Alpine.data('wireui_select', select)
  Alpine.data('wireui_timepicker', timePicker)
}

export default start
