import colorPicker from './colorPicker'

document.addEventListener('alpine:init', () => {
  window.Alpine.store('wireui:color-picker', colorPicker)
})
