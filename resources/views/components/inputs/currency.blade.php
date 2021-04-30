<div x-data="{
    model: @entangle($attributes->wire('model')),
    input: null,
    config: {
        isLazy: @json($attributes->wire('model')->hasModifier('lazy')),
        thousands: '{{ $thousands }}',
        decimal:   '{{ $decimal }}',
        precision:  {{ $precision }},
        emitFormatted: @json(filter_var($emitFormatted, FILTER_VALIDATE_BOOLEAN)),
    },

    mask(currency, emitInput = true) {
        if (typeof currency === 'number') {
            currency = currency.toString()
        }

        if (
            currency?.endsWith(this.config.decimal)
            && $wireui.utils.occurrenceCount(currency, this.config.decimal) === 1
        ) {
            if (currency.length === 1) {
                return this.input = '0.'
            }

            return
        }

        this.input = $wireui.utils.currency.mask(currency, this.config)

        if (!this.config.isLazy && emitInput) {
            this.emitInput(this.input)
        }
    },
    unMask(currency) {
        return $wireui.utils.currency.unMask(currency, this.config)
    },
    emitInput(currency) {
        this.model = this.config.emitFormatted
            ? currency
            : this.unMask(currency)
    },
}"
x-init="function() {
    if (typeof this.model !== 'object') {
        this.mask(this.model)
    }

    $watch('model', value => this.mask(value, false))
}">
    <x-input {{ $attributes->whereDoesntStartWith('wire:model')->except('type') }}
        :color="$color"
        :label="$label"
        :hint="$hint"
        :corner-hint="$cornerHint"
        :icon="$icon"
        :right-icon="$rightIcon"
        :prefix="$prefix"
        :suffix="$suffix"
        :prepend="$prepend"
        :append="$append"
        x-model="input"
        x-on:input="mask($event.target.value)"
        @if ($attributes->wire('model')->hasModifier('lazy'))
            x-on:blur="emitInput($event.target.value)"
        @endif
    />
</div>
