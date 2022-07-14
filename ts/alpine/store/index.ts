import colorPicker from './colorPicker'
import modal from './modal'

document.addEventListener('alpine:init', () => {
  window.Alpine.store('wireui:color-picker', colorPicker)
  window.Alpine.store('wireui:modal', modal)
})
