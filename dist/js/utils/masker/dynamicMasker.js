import masker from './masker';
export default (masks, value, masked = true) => {
    masks = masks.sort((a, b) => a.length - b.length);
    let i = 0;
    while (i < masks.length) {
        const currentMask = masks[i];
        i++;
        const nextMask = masks[i];
        if (!(nextMask && (masker(nextMask, value, true)?.length ?? 0) > currentMask.length)) {
            return masker(currentMask, value, masked);
        }
    }
    return '';
};
//# sourceMappingURL=dynamicMasker.js.map