export const unMaskCurrency = (value, config) => {
    if (!value)
        return null;
    const currency = parseFloat(value.replace(new RegExp(`\\${config.thousands}`, 'g'), '').replace(config.decimal, '.'));
    const isNegative = value.startsWith('-');
    return isNegative ? -Math.abs(currency) : Math.abs(currency);
};
//# sourceMappingURL=unMaskCurrency.js.map