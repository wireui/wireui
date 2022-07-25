<div x-data="wireui_show_password" {{ $attributes->only('wire:key') }}>
    <x-dynamic-component
        :component="WireUi::component('input')"
        {{ $attributes->whereDoesntStartWith(['wire:key'])->except(['type', 'right-icon', 'rightIcon','suffix', 'append']) }}
        :borderless="$borderless"
        :shadowless="$shadowless"
        :label="$label"
        :hint="$hint"
        :corner-hint="$cornerHint"
        :icon="$icon"
        :prefix="$prefix"
        :prepend="$prepend"
        ::type="type()"
    >
        <x-slot name="append">
            <div class="absolute inset-y-0 right-0 pr-2.5 flex items-center">
                <div
                    x-on:click="toggle()"
                    class="text-gray-700 cursor-pointer"
                    :class="{'block': !status, 'hidden': status }"
                >
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        name="eye-off"
                        class="w-5 h-5"
                    />
                </div>
                <div
                    x-on:click="toggle()"
                    class="text-gray-700 cursor-pointer"
                    :class="{'hidden': !status, 'block': status }"
                >
                    <x-dynamic-component
                        :component="WireUi::component('icon')"
                        name="eye"
                        class="w-5 h-5"
                    />
                </div>
            </div>
        </x-slot>
    </x-dynamic-component>
</div>
