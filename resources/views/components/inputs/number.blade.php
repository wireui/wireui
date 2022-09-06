<div x-data="wireui_inputs_number({
    disabled: @boolean($disabled),
    readonly: @boolean($readonly),
})" {{ $attributes->only('wire:key') }}>
    <x-dynamic-component
        :component="WireUi::component('input')"
        x-ref="input"
        type="number"
        inputmode="numeric"
        {{ $attributes
            ->class('text-center appearance-number-none')
            ->whereDoesntStartWith('wire:key')
            ->except($except) }}
        :borderless="$borderless"
        :shadowless="$shadowless"
        :label="$label"
        :hint="$hint"
        :corner-hint="$cornerHint"
        x-on:keydown.up.prevent="plus"
        x-on:keydown.down.prevent="minus"
    >
        <x-slot name="prepend">
            <div class="absolute inset-y-0 left-0 flex items-center p-0.5">
                <x-dynamic-component
                    :component="WireUi::component('button')"
                    x-hold.click.delay.repeat.100ms="minus"
                    x-on:keydown.enter="minus"
                    class="h-full rounded-l-md"
                    icon="minus"
                    primary
                    flat
                    squared
                    x-bind:disabled="disableMinus"
                />
            </div>
        </x-slot>

        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                <x-dynamic-component
                    :component="WireUi::component('button')"
                    x-hold.click.delay.repeat.100ms="plus"
                    x-on:keydown.enter="plus"
                    class="h-full rounded-r-md"
                    icon="plus"
                    primary
                    flat
                    squared
                    x-bind:disabled="disablePlus"
                />
            </div>
        </x-slot>
    </x-dynamic-component>
</div>
