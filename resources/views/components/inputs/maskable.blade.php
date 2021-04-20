<div x-data="{
    @if ($attributes->wire('model')->value())
        model: @entangle($attributes->wire('model')),
    @else
        model: null,
    @endif
    input: null,
    masker: null,
    config: {
        mask: {{ $mask }},
        emitFormatted: @json(filter_var($emitFormatted, FILTER_VALIDATE_BOOLEAN))
    },

    emitInput(value) {
        this.input = this.masker.apply(value).value
        this.model = this.config.emitFormatted
            ? this.masker.value
            : this.masker.original
    }
}"
x-init="function() {
    this.masker = $wireui.utils.masker(this.config.mask, this.model)
    this.input  = this.masker.value

    $watch('model', value => {
        this.input = this.masker.apply(value).value
    })
}">
    <x-input
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
        x-on:input="emitInput($event.target.value)"
        {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model']) }}
    />
</div>
