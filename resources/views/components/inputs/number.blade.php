<div x-data="wireui_inputs_number" {{ $attributes->only('wire:key') }}>
    <x-dynamic-component
        type="number"
        x-ref="inputNumber"
        x-on:input.debounce="checkStatus()"
        class="text-center no-arrow"
        :component="WireUi::component('input')"
        {{ $attributes->whereDoesntStartWith(['wire:key'])->except($except) }}
        :borderless="$borderless"
        :shadowless="$shadowless"
        :label="$label"
        :hint="$hint"
        :corner-hint="$cornerHint"
        x-on:keydown.up.prevent="plus()"
        x-on:keydown.down.prevent="minus()"
    >
        <x-slot name="prepend">
            <div class="absolute inset-y-0 left-0 flex items-center p-0.5">
                <x-button
                    x-on:click="minus()"
                    x-on:keydown.enter="minus()"
                    class="h-full rounded-l-md"
                    icon="minus"
                    primary
                    flat
                    squared
                    ::disabled="minusStatus"
                />
            </div>
        </x-slot>

        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                <x-button
                    x-on:click="plus()"
                    x-on:keydown.enter="plus()"
                    class="h-full rounded-r-md"
                    icon="plus"
                    primary
                    flat
                    squared
                    ::disabled="plusStatus"
                />
            </div>
        </x-slot>
    </x-dynamic-component>
</div>
