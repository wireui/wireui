import { props } from './props'

document.addEventListener('alpine:init', () => {
  window.Alpine.magic('props', props)
})
