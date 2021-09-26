import { onlyNumbers } from '../helpers';
const getOutput = (value, iValue, pattern) => {
    const digits = onlyNumbers(value.slice(iValue, iValue + 2));
    if (digits.length === 2 && pattern?.test(digits)) {
        return digits;
    }
    return value[iValue];
};
export const hour24Token = {
    pattern: /([01][0-9])|(2[0-3])/,
    validate(value, iValue) {
        const hours = onlyNumbers(value.slice(iValue, iValue + 2));
        if (hours.length === 2 && this.pattern?.test(hours)) {
            return true;
        }
        return /[0-2]/.test(hours);
    },
    output(value, iValue) {
        return getOutput(value, iValue, this.pattern);
    }
};
export const hour12Token = {
    pattern: /[1-9]|1[0-2]/,
    validate(value, iValue) {
        const hours = onlyNumbers(value.slice(iValue, iValue + 2));
        if (hours.length === 2) {
            return /1[0-2]/.test(hours);
        }
        return /[1-9]/.test(hours);
    },
    output(value, iValue) {
        return getOutput(value, iValue, this.pattern);
    }
};
export const minutesToken = {
    pattern: /[0-5][0-9]/,
    validate(value, iValue) {
        const minutes = onlyNumbers(value.slice(iValue, iValue + 2));
        if (/[0-5]/.test(minutes[0]) && /[0-9]/.test(minutes[1])) {
            return Boolean(this.pattern?.test(minutes));
        }
        return /[0-5]/.test(value[iValue]);
    },
    output(value, iValue) {
        return getOutput(value, iValue, this.pattern);
    }
};
//# sourceMappingURL=timeTokens.js.map