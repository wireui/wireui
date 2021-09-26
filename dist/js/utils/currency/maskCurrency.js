import { str, onlyNumbers } from '../helpers';
const splitCurrency = (numbers, config) => {
    if (!numbers)
        return [];
    let [digits = null, decimals = null] = numbers?.split(config.decimal);
    digits = onlyNumbers(digits);
    decimals = onlyNumbers(decimals);
    if (decimals?.length > config.precision && config.precision > 0) {
        digits += decimals.slice(0, decimals.length - config.precision);
        decimals = decimals.slice(-Math.abs(config.precision));
    }
    if (digits) {
        digits = parseInt(digits).toString();
    }
    return [digits, decimals];
};
const applyCurrencyMask = (numbers, separator) => {
    return numbers.replace(/\B(?=(\d{3})+(?!\d))/g, separator);
};
export const maskCurrency = (value = null, config) => {
    if (typeof value === 'number') {
        value = value.toString().replace('.', config.decimal);
    }
    const [digits = null, decimals = null] = splitCurrency(value, config);
    let currency = applyCurrencyMask(str(digits), config.thousands);
    if (value?.startsWith('-')) {
        currency = `-${currency}`;
    }
    if (decimals && config.precision > 0) {
        currency = `${currency}${config.decimal}${decimals}`;
    }
    return currency;
};
//# sourceMappingURL=maskCurrency.js.map