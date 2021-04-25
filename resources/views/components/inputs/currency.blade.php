<div x-data="{
    model: @entangle($attributes->wire('model')),
    input: null,
    isLazy: @json($attributes->wire('model')->hasModifier('lazy')),
    config: {
        thousands: '{{ $thousands }}',
        decimal:   '{{ $decimal }}',
        precision:  {{ $precision }},
        emitFormatted: @json(filter_var($emitFormatted, FILTER_VALIDATE_BOOLEAN)),
    },

    countOccurrence(needle, haystack) {
        const regex = new RegExp(`\\${needle}`, 'g')

        return (haystack.match(regex) || []).length
    },
    mask(currency, emitInput = true) {
        if (typeof currency === 'number') {
            currency = currency.toString()
        }

        if (currency?.endsWith(this.config.decimal) && this.countOccurrence(this.config.decimal, currency) === 1) {
            if (currency.length === 1) {
                return this.input = '0.'
            }

            return
        }

        this.input = $wireui.utils.currency.mask(currency, this.config)

        if (!this.isLazy && emitInput) {
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
    this.mask(this.model)

    $watch('model', value => {
        if (this.unMask(value?.toString()) !== this.unMask(this.input)) {
            this.mask(value, false)
        }
    })
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
            x-on:blur="emitInput"
        @endif
    />
</div>
