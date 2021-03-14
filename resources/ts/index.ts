import utils, { Utilities } from './utils'
import { notify, Notification } from './notification'
import livewireActions, { LivewireActions } from './livewire-actions'

export interface WireUi {
  utils: Utilities
  notify: Notification
  livewire: LivewireActions
}

declare global {
  interface Window {
    $wireui: WireUi
    Livewire: any
  }
}

const wireui = {
  utils,
  notify,
  livewire: livewireActions
}

window.$wireui = wireui

export default wireui
