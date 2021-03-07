export interface WireUi {
}

declare global {
  interface Window {
    $wireui: WireUi
    Livewire: any
  }
}

const wireui = {
}

window.$wireui = wireui

export default wireui
