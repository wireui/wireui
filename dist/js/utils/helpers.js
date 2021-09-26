export const str = (value) => {
    return value ? value.toString() : '';
};
export const onlyNumbers = (value) => {
    return str(value).replace(/\D+/g, '');
};
export const occurrenceCount = (haystack, needle) => {
    const regex = new RegExp(`\\${needle}`, 'g');
    return (haystack?.match(regex) || []).length;
};
//# sourceMappingURL=helpers.js.map