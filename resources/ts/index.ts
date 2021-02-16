import { notify, Notify } from './sweetAlert'

export interface WireUi {
    notify (notify: Notify): void
}

declare global {
    interface Window {
        $wireui: WireUi
    }
}

const wireui = {
    notify
}

window.$wireui = wireui

export default wireui
