import { parseRedirect, parseLivewire } from '../notifications/parses';
const colors = ['primary', 'secondary', 'positive', 'negative', 'warning', 'info', 'dark'];
export const parseAction = (options, componentId) => {
    if (options?.url)
        return parseRedirect(options.url);
    if (options?.method && componentId)
        return parseLivewire({ ...options, id: componentId });
    return () => null;
};
const getActionLabel = (options, action, actionName) => {
    const defaultLabels = { accept: 'Confirm', reject: 'Cancel' };
    return action?.label
        ?? options[`${actionName}Label`]
        ?? defaultLabels[actionName];
};
export const iconsMap = {
    question: 'primary',
    success: 'positive',
    error: 'negative'
};
export const parseActions = (options, componentId) => {
    if (options.method) {
        options.accept = Object.assign({
            method: options.method,
            params: options.params
        }, options.accept);
    }
    return Object.assign({}, ...['accept', 'reject'].map(actionName => {
        const action = Object.assign({}, options[actionName]);
        action.label = getActionLabel(options, action, actionName);
        if (!action.execute) {
            action.execute = parseAction(action, componentId);
        }
        if (actionName === 'accept'
            && !action.color
            && typeof options.icon === 'string') {
            action.color = iconsMap[options.icon] ?? options.icon;
        }
        if (actionName === 'accept' && !action.color) {
            action.color = 'primary';
        }
        return { [actionName]: action };
    }));
};
//# sourceMappingURL=actions.js.map