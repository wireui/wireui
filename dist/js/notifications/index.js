import { icons } from './icons';
import { parseConfirmation, parseNotification } from './parses';
import { timer } from './timer';
export const notify = (options, componentId) => {
    const event = new CustomEvent('wireui:notification', { detail: { options, componentId } });
    window.dispatchEvent(event);
};
export const confirmNotification = (options, componentId) => {
    options = Object.assign({
        icon: icons['warning'],
        title: 'Are you sure?',
        description: 'You won\'t be able to revert this!'
    }, options);
    const event = new CustomEvent('wireui:confirm-notification', { detail: { options, componentId } });
    window.dispatchEvent(event);
};
export const notifications = {
    parseNotification,
    parseConfirmation,
    timer
};
//# sourceMappingURL=index.js.map