import currency from '../../utils/currency';
import { occurrenceCount } from '../../utils/helpers';
export default (options) => ({
    model: options.model,
    input: null,
    config: {
        emitFormatted: options.emitFormatted,
        isLazy: options.isLazy,
        thousands: options.thousands,
        decimal: options.decimal,
        precision: options.precision
    },
    init() {
        if (typeof this.model !== 'object') {
            this.mask(this.model);
        }
        this.$watch('model', value => {
            if (!this.config.emitFormatted) {
                value = currency.mask(value, this.config);
            }
            if (value !== this.input) {
                this.mask(value, false);
            }
        });
    },
    mask(value, emitInput = true) {
        if (typeof value === 'number') {
            value = value.toFixed(this.config.precision).toString();
        }
        if (value?.endsWith(this.config.decimal) && occurrenceCount(value, this.config.decimal) === 1) {
            if (value.length === 1) {
                this.input = `0.${this.config.decimal}`;
                return;
            }
            return;
        }
        this.input = currency.mask(value, this.config);
        if (!this.config.isLazy && emitInput) {
            this.emitInput(this.input);
        }
    },
    unMask(value) {
        return currency.unMask(value, this.config);
    },
    emitInput(value) {
        this.model = this.config.emitFormatted
            ? value
            : this.unMask(value);
    }
});
//# sourceMappingURL=currency.js.map