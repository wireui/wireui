import classToObject from '@/utils/classToObject'
import ColorPicker from './color-picker'
import datetimePicker from './datetime-picker'
import dialog from './dialog'
import Dropdown from './Dropdown'
import currency from './inputs/currency'
import maskable from './inputs/maskable'
import number from './inputs/number'
import password from './inputs/password'
import modal from './modal'
import notifications from './notifications'
import select from './select'
import TimePicker from './TimePicker'
import TimeSelector from './TimeSelector'

document.addEventListener('alpine:init', () => {
  window.Alpine.data('wireui_modal', modal)
  window.Alpine.data('wireui_dialog', dialog)
  window.Alpine.data('wireui_notifications', notifications)
  window.Alpine.data('wireui_inputs_maskable', maskable)
  window.Alpine.data('wireui_inputs_currency', currency)
  window.Alpine.data('wireui_inputs_number', number)
  window.Alpine.data('wireui_inputs_password', password)
  window.Alpine.data('wireui_select', select)
  window.Alpine.data('wireui_datetime_picker', datetimePicker)

  window.Alpine.data('wireui_dropdown', () => classToObject(new Dropdown()))
  window.Alpine.data('wireui_color_picker', () => classToObject(new ColorPicker()))
  window.Alpine.data('wireui_time_selector', () => classToObject(new TimeSelector()))
  window.Alpine.data('wireui_time_picker', () => classToObject(new TimePicker()))
})
