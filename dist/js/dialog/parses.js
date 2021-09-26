import { iconsMap, parseActions } from './actions';
import { parseEvents } from './events';
import { parseIcon } from './icons';
export const parseDialog = (options, componentId) => {
    const dialog = Object.assign({
        closeButton: true,
        progressbar: true,
        style: 'center',
        close: 'OK'
    }, options);
    if (typeof dialog.icon === 'string') {
        dialog.icon = parseIcon({
            name: dialog.icon,
            color: options.iconColor,
            background: options.iconBackground
        });
    }
    if (typeof dialog.close === 'string') {
        dialog.close = { label: dialog.close };
    }
    if (typeof dialog.close === 'object'
        && !dialog.close.color
        && typeof options.icon === 'string') {
        dialog.close.color = iconsMap[options.icon] ?? options.icon;
    }
    const { onClose, onDismiss, onTimeout } = parseEvents(options, componentId);
    return {
        ...dialog,
        onClose,
        onDismiss,
        onTimeout
    };
};
export const parseConfirmation = (options, componentId) => {
    options = Object.assign({ style: 'inline' }, options);
    const dialog = parseDialog(options, componentId);
    const { accept, reject } = parseActions(options, componentId);
    return {
        ...dialog,
        accept,
        reject
    };
};
//# sourceMappingURL=parses.js.map