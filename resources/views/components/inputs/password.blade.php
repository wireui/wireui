<div x-data="wireui_inputs_password" {{ $attributes->only('wire:key')->class('w-full') }}>
    <x-dynamic-component
        :component="WireUi::component('input')"
        {{ $attributes->except('wire:key') }}
        :borderless="$borderless"
        :shadowless="$shadowless"
        :label="$label"
        :hint="$hint"
        :corner-hint="$cornerHint"
        :icon="$icon"
        :prefix="$prefix"
        :prepend="$prepend"
        x-bind:type="type"
        type="password"
    >
        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center">
                <div x-on:click="toggle" class="text-gray-400 cursor-pointer">
                    <x-dynamic-component
                        x-show="!status"
                        :component="WireUi::component('icon')"
                        name="eye-off"
                        class="w-5 h-5"
                    />
                    <x-dynamic-component
                        x-show="status"
                        :component="WireUi::component('icon')"
                        name="eye"
                        class="w-5 h-5"
                    />
                </div>
            </div>
        </x-slot>
    </x-dynamic-component>
</div>
