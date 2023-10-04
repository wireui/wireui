import Dropdown from './Dropdown'
import Modal from './Modal'
import Dialog from './dialog/dialog'
import Notifications from './notifications/notifications'
import Maskable from './inputs/maskable'
import Currency from './inputs/currency'
import Number from './inputs/number'
import Password from './inputs/password'
import Select from './select'
import TimePicker from './time-picker'
import DatetimePicker from './datetime-picker'
import ColorPicker from './color-picker'
import { convertClassToObject } from '@/alpine/components/alpine'

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
      (params: any) => convertClassToObject(new Component(params))
    )
  })
})
