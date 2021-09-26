import { parseActions } from './actions';
import { parseEvents } from './events';
import { parseIcon } from './icons';
export const parseRedirect = (redirect) => {
    return () => { window.location.href = redirect; };
};
export const parseLivewire = ({ id, method, params = undefined }) => {
    return () => {
        const component = window.Livewire.find(id);
        if (params !== undefined) {
            return Array.isArray(params)
                ? component?.call(method, ...params)
                : component?.call(method, params);
        }
        component?.call(method);
    };
};
export const parseNotification = (options, componentId) => {
    const notification = Object.assign({
        closeButton: true,
        progressbar: true,
        timeout: 8500
    }, options);
    if (typeof options.icon === 'string') {
        notification.icon = parseIcon({ name: options.icon, color: options.iconColor });
    }
    const { onClose, onDismiss, onTimeout } = parseEvents(options, componentId);
    return {
        ...notification,
        onClose,
        onDismiss,
        onTimeout
    };
};
export const parseConfirmation = (options, componentId) => {
    const notification = parseNotification(options, componentId);
    const { accept, reject } = parseActions(options, componentId);
    return {
        ...notification,
        accept,
        reject
    };
};
//# sourceMappingURL=parses.js.map