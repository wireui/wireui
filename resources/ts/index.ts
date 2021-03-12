import utils, { Utilities } from './utils'

export interface WireUi {
  utils: Utilities
}

declare global {
  interface Window {
    $wireui: WireUi
    Livewire: any
  }
}

const wireui = {
  utils
}

window.$wireui = wireui

export default wireui
