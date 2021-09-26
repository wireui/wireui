import { parseLivewire, parseRedirect } from '../notifications/parses';
export const parseEvent = (options, componentId) => {
    if (options?.url)
        return parseRedirect(options.url);
    if (options?.method && componentId)
        return parseLivewire({ ...options, id: componentId });
    return () => null;
};
export const events = ['onClose', 'onTimeout', 'onDismiss'];
export const parseEvents = (options, componentId) => {
    return Object.assign({}, ...events.map(eventName => {
        const event = options[eventName];
        if (typeof event === 'function') {
            return { [eventName]: event };
        }
        return { [eventName]: parseEvent(event, componentId) };
    }));
};
//# sourceMappingURL=events.js.map