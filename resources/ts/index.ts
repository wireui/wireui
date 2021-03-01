import livewireActions, { LivewireActions } from './livewire-actions'
import notifier, { Notifier } from './notifier'

export interface WireUi extends Notifier {
  livewire: LivewireActions
}

declare global {
  interface Window {
    $wireui: WireUi
    Livewire: any
  }
}

const wireui = {
  ...notifier,
  livewire: livewireActions
}

window.$wireui = wireui

export default wireui
