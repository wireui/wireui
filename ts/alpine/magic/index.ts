import props from './props'
import tooltip from './tooltip'

document.addEventListener('alpine:init', () => {
  window.Alpine.magic('props', props)
  window.Alpine.magic('tooltip', tooltip)
})
