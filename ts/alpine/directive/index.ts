import tooltip from './tooltip'

document.addEventListener('alpine:init', () => {
  window.Alpine.directive('tooltip', tooltip)
})
