import dropdown from './dropdown'
import modal from './modal'
import dialog from './dialog'
import notifications from './notifications'
import maskable from './inputs/maskable'
import currency from './inputs/currency'
import select from './select'
import timePicker from './timePicker'
import datetimePicker from './datetime-picker'

document.addEventListener('alpine:init', () => {
  window.Alpine.data('wireui_dropdown', dropdown)
  window.Alpine.data('wireui_modal', modal)
  window.Alpine.data('wireui_dialog', dialog)
  window.Alpine.data('wireui_notifications', notifications)
  window.Alpine.data('wireui_inputs_maskable', maskable)
  window.Alpine.data('wireui_inputs_currency', currency)
  window.Alpine.data('wireui_select', select)
  window.Alpine.data('wireui_timepicker', timePicker)
  window.Alpine.data('wireui_datetime_picker', datetimePicker)
})
