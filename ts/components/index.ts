import classToObject from '@/utils/classToObject'
import ColorPicker from './color-picker'
import DatePicker from './date-picker'
import dialog from './dialog'
import Dropdown from './Dropdown'
import Currency from './inputs/currency'
import maskable from './inputs/maskable'
import NumberInput from './inputs/number'
import Password from './inputs/password'
import modal from './modal'
import notifications from './notifications'
import Select from './select'
import TimePicker from './TimePicker'
import TimeSelector from './TimeSelector'

document.addEventListener('alpine:init', () => {
  window.Alpine.data('wireui_modal', modal)
  window.Alpine.data('wireui_dialog', dialog)
  window.Alpine.data('wireui_notifications', notifications)
  window.Alpine.data('wireui_inputs_maskable', maskable)

  window.Alpine.data('wireui_color_picker', () => classToObject(new ColorPicker()))
  window.Alpine.data('wireui_date_picker', () => classToObject(new DatePicker()))
  window.Alpine.data('wireui_dropdown', () => classToObject(new Dropdown()))
  window.Alpine.data('wireui_inputs_currency', () => classToObject(new Currency()))
  window.Alpine.data('wireui_inputs_number', () => classToObject(new NumberInput()))
  window.Alpine.data('wireui_inputs_password', () => classToObject(new Password()))
  window.Alpine.data('wireui_select', () => classToObject(new Select()))
  window.Alpine.data('wireui_time_selector', () => classToObject(new TimeSelector()))
  window.Alpine.data('wireui_time_picker', () => classToObject(new TimePicker()))
})
