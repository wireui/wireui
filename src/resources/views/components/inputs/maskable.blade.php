<div x-data="wireui_inputs_maskable({
    isLazy: @boolean($attributes->wire('model')->hasModifier('lazy')),
    model: @entangle($attributes->wire('model')),
    emitFormatted: @boolean($emitFormatted),
    mask: {{ $mask }},
})" {{ $attributes->only('wire:key') }}>
    <x-dynamic-component
        :component="WireUi::component('input')"
        :borderless="$borderless"
        :shadowless="$shadowless"
        :label="$label"
        :description="$description"
        :corner="$corner"
        :icon="$icon"
        :right-icon="$rightIcon"
        :prefix="$prefix"
        :suffix="$suffix"
        x-model="input"
        x-on:input="onInput($event.target.value)"
        x-on:blur="emitInput"
        {{ $attributes->whereDoesntStartWith(['wire:model', 'x-model', 'wire:key']) }}
    />
</div>
