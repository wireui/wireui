import { colors } from '../notifications/icons';
export const icons = {
    'success': {
        name: 'check',
        color: colors['success'],
        background: 'p-2 bg-positive-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
    },
    'error': {
        name: 'exclamation',
        color: colors['error'],
        background: 'p-2 bg-negative-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
    },
    'info': {
        name: 'information-circle',
        color: colors['info'],
        background: 'p-2 bg-info-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
    },
    'warning': {
        name: 'exclamation-circle',
        color: colors['warning'],
        background: 'p-2 bg-warning-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
    },
    'question': {
        name: 'question-mark-circle',
        color: colors['question'],
        background: 'p-2 bg-secondary-50 dark:bg-secondary-700 border dark:border-0 rounded-3xl'
    }
};
export const parseIcon = (options) => {
    if (icons[options.name]) {
        const { name, color, background } = icons[options.name];
        options.name = name;
        if (!options.style) {
            options.style = 'outline';
        }
        if (!options.color) {
            options.color = color;
        }
        if (!options.background) {
            options.background = background;
        }
    }
    return options;
};
//# sourceMappingURL=icons.js.map