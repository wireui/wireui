import { parseDialog, parseConfirmation } from './parses';
const makeEventName = (id) => {
    const event = 'dialog';
    if (id) {
        return `${event}:${id}`;
    }
    return event;
};
export const showDialog = (options, componentId) => {
    const event = new CustomEvent(`wireui:${makeEventName(options.id)}`, { detail: { options, componentId } });
    window.dispatchEvent(event);
};
export const showConfirmDialog = (options, componentId) => {
    if (!options.icon) {
        options.icon = 'question';
    }
    const event = new CustomEvent(`wireui:confirm-${makeEventName(options.id)}`, { detail: { options, componentId } });
    window.dispatchEvent(event);
};
export const dialogs = {
    parseDialog,
    parseConfirmation
};
//# sourceMappingURL=index.js.map