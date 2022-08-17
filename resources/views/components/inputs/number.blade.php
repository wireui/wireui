<div x-data="wireui_inputs_number({
    @if ($attributes->wire('model')->value())
        wireModel: @entangle($attributes->wire('model')).defer,
    @endif
})" {{ $attributes->only('wire:key') }}>
    <x-dynamic-component
        type="number"
        inputmode="numeric"
        {{ $attributes
            ->class('appearance-number-none')
            ->whereDoesntStartWith('wire:key')
            ->except($except) }}
        x-ref="input"
        class="text-center no-arrow"
        :component="WireUi::component('input')"
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
                @if ($disabled)
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="h-full rounded-l-md"
                        icon="minus"
                        primary
                        flat
                        squared
                        disabled
                    >
                    </x-dynamic-component>
                @else
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        x-hold.click.delay.repeat.100ms="minus"
                        x-on:keydown.enter="minus()"
                        class="h-full rounded-l-md"
                        icon="minus"
                        primary
                        flat
                        squared
                        ::disabled="disableMinus"
                    >
                    </x-dynamic-component>
                @endif
            </div>
        </x-slot>

        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 flex items-center p-0.5">
                @if ($disabled)
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        class="h-full rounded-l-md"
                        icon="plus"
                        primary
                        flat
                        squared
                        disabled
                    >
                    </x-dynamic-component>
                @else
                    <x-dynamic-component
                        :component="WireUi::component('button')"
                        x-hold.click.delay.repeat.100ms="plus"
                        x-on:keydown.enter="plus()"
                        class="h-full rounded-r-md"
                        icon="plus"
                        primary
                        flat
                        squared
                        ::disabled="disablePlus"
                    >
                    </x-dynamic-component>
                @endif
            </div>
        </x-slot>
    </x-dynamic-component>
</div>
