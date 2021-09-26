import { hour24Token, hour12Token, minutesToken } from './timeTokens';
export const tokens = {
    '#': { pattern: /\d/ },
    'X': { pattern: /[0-9a-zA-Z]/ },
    'S': { pattern: /[a-zA-Z]/ },
    'A': { pattern: /[a-zA-Z]/, transform: (v) => v.toLocaleUpperCase() },
    'a': { pattern: /[a-zA-Z]/, transform: (v) => v.toLocaleLowerCase() },
    '!': { escape: true },
    'H': hour24Token,
    'h': hour12Token,
    'm': minutesToken
};
export default tokens;
//# sourceMappingURL=tokens.js.map