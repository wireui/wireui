import { masker } from '../../utils/masker';
export default (options) => ({
    model: options.model,
    input: null,
    masker: masker(options.mask, null),
    config: {
        emitFormatted: options.emitFormatted,
        isLazy: options.isLazy,
        mask: options.mask
    },
    init() {
        this.input = this.masker.apply(this.model).value;
        this.$watch('model', value => {
            this.input = this.masker.apply(value).value;
        });
    },
    onInput(value) {
        this.input = this.masker.apply(value).value;
        if (!this.config.isLazy) {
            this.emitInput();
        }
    },
    emitInput() {
        this.model = this.config.emitFormatted
            ? this.masker.value
            : this.masker.getOriginal();
    }
});
//# sourceMappingURL=maskable.js.map