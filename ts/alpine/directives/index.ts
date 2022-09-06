import { directive } from '@wireui/alpinejs-hold-directive'

document.addEventListener('alpine:init', () => {
  window.Alpine.directive('hold', directive as any)
})
