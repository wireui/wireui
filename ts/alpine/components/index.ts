import { convertClassToObject } from '@/alpine/components/alpine'
import ColorPicker from './color-picker'
import DatetimePicker from './datetime-picker'
import Dialog from './dialog/dialog'
import Dropdown from './Dropdown'
import Currency from './inputs/currency'
import Maskable from './inputs/maskable'
import Number from './inputs/number'
import Password from './inputs/password'
import Modal from './Modal'
import Notifications from './notifications/notifications'
import Select from './select'
import TimePicker from './time-picker'

document.addEventListener('alpine:init', () => {
  const components = {
    dropdown: Dropdown,
    modal: Modal,
    dialog: Dialog,
    notifications: Notifications,
    inputs_maskable: Maskable,
    inputs_currency: Currency,
    inputs_number: Number,
    inputs_password: Password,
    select: Select,
    timepicker: TimePicker,
    datetime_picker: DatetimePicker,
    color_picker: ColorPicker
  }

  Object.entries(components).forEach(([name, Component]) => {
    window.Alpine.data(
      `wireui_${name}`,
      () => convertClassToObject(new Component())
    )
  })
})
