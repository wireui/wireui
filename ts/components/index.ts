import ColorPicker from './color-picker'
import DatePicker from './date-picker'
import dialog from './dialog'
import Dropdown from './Dropdown'
import Currency from './inputs/currency'
import Maskable from './inputs/maskable'
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

  window.Alpine.data('wireui_color_picker', () => new ColorPicker())
  window.Alpine.data('wireui_date_picker', () => new DatePicker())
  window.Alpine.data('wireui_dropdown', () => new Dropdown())
  window.Alpine.data('wireui_inputs_currency', () => new Currency())
  window.Alpine.data('wireui_inputs_number', () => new NumberInput())
  window.Alpine.data('wireui_inputs_password', () => new Password())
  window.Alpine.data('wireui_inputs_maskable', () => new Maskable())
  window.Alpine.data('wireui_select', () => new Select())
  window.Alpine.data('wireui_time_selector', () => new TimeSelector())
  window.Alpine.data('wireui_time_picker', () => new TimePicker())
})
