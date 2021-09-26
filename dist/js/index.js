import { notify, confirmNotification } from './notifications';
import { confirmAction } from './confirmAction';
import { showDialog, showConfirmDialog } from './dialog';
import { start } from './components';
import { dataGet } from './utils/dataGet';
import './directives/confirm';
import './browserSupport';
import './global';
const wireui = {
    notify,
    confirmNotification,
    confirmAction,
    dialog: showDialog,
    confirmDialog: showConfirmDialog,
    start,
    dataGet
};
window.$wireui = wireui;
document.addEventListener('DOMContentLoaded', () => window.Wireui.dispatchHook('load'));
export default wireui;
//# sourceMappingURL=index.js.map