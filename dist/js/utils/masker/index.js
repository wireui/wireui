import dynamicMasker from './dynamicMasker';
import singleMasker from './masker';
import { str } from '../helpers';
export const applyMask = (mask, value, masked = true) => {
    return Array.isArray(mask)
        ? dynamicMasker(mask, str(value), masked)
        : singleMasker(mask, str(value), masked);
};
export const masker = (mask, value) => {
    return {
        mask,
        value,
        getOriginal() {
            return applyMask(this.mask, this.value, false);
        },
        apply(value) {
            this.value = applyMask(this.mask, value);
            return this;
        }
    }.apply(value);
};
export default masker;
//# sourceMappingURL=index.js.map