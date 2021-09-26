import { unMaskCurrency } from './unMaskCurrency';
import { maskCurrency } from './maskCurrency';
export const defaultConfig = {
    thousands: ',',
    decimal: '.',
    precision: 2
};
export const currency = {
    mask: maskCurrency,
    unMask: unMaskCurrency
};
export default currency;
//# sourceMappingURL=index.js.map