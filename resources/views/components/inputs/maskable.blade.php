<div x-data="{
    model: @entangle($attributes->wire('model')),
    input: null,
    masker: null,
    config: {
        isLazy: @boolean($attributes->wire('model')->hasModifier('lazy')),
        mask: {{ $mask }},
        emitFormatted: @boolean($emitFormatted)
    },

    onInput(value) {
        this.input = this.masker.apply(value).value

        if (!this.config.isLazy) {
            this.emitInput()
        }
    },
    emitInput() {
        this.model = this.config.emitFormatted
            ? this.masker.value
            : this.masker.getOriginal()
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
        :borderless="$borderless"
        :shadowless="$shadowless"
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
        x-on:input="onInput($event.target.value)"
        x-on:blur="emitInput"
        {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model']) }}
    />
</div>
