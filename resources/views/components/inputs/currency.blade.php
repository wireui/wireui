<div x-data="wireui_inputs_currency({
    isBlur: @boolean($attributes->wire('model')->hasModifier('blur')),
    model:  @entangleable($attributes->wire('model')),
    emitFormatted: @boolean($emitFormatted),
    thousands: '{{ $thousands }}',
    decimal:   '{{ $decimal }}',
    precision:  {{ $precision }},
})" {{ $attributes->only('wire:key')->class('w-full') }}>
    <x-dynamic-component
        :component="WireUi::component('input')"
        {{ $attributes->whereDoesntStartWith(['wire:model'])->except(['type', 'wire:key']) }}
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
        x-on:input="mask($event.target.value)"
        x-on:blur="emitInput($event.target.value)"
    />
</div>
