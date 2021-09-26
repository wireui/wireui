import tokens from './tokens';
import { str } from '../helpers';
const replaceTokens = (iMask, mask, value, masked) => {
    let iValue = 0;
    let output = '';
    while (iMask < mask.length && iValue < value.length) {
        let cMask = mask[iMask];
        const token = tokens[cMask];
        const cValue = value[iValue];
        if (token && !token.escape) {
            if (token.validate && token.validate(value, iValue) && token.output) {
                const tokenOutput = token.output(value, iValue);
                output += tokenOutput;
                iValue += tokenOutput.length;
                iMask++;
                continue;
            }
            if (token.pattern?.test(cValue)) {
                output += token.transform ? token.transform(cValue) : cValue;
                iMask++;
            }
            iValue++;
            continue;
        }
        if (token && token.escape) {
            iMask++;
            cMask = mask[iMask];
        }
        if (masked) {
            output += cMask;
        }
        if (cValue === cMask) {
            iValue++;
        }
        iMask++;
    }
    return output;
};
const getUnreplacedOutput = (iMask, mask, masked) => {
    let restOutput = '';
    while (iMask < mask.length && masked) {
        const cMask = mask[iMask];
        if (tokens[cMask]) {
            return '';
        }
        restOutput += cMask;
        iMask++;
    }
    return restOutput;
};
export const mask = (mask, value = null, masked = true) => {
    value = str(value);
    const iMask = 0;
    const output = replaceTokens(iMask, mask, value, masked);
    const unreplaced = getUnreplacedOutput(iMask, mask, masked);
    return output + unreplaced || null;
};
export default mask;
//# sourceMappingURL=masker.js.map