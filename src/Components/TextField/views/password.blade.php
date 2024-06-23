<x-dynamic-component
    :component="WireUi::component('text-field')"
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'class'])"
    x-data="wireui_inputs_password"
>
    @include('wireui-wrapper::components.slots', [
        'except' => ['append'],
    ])

    <x-wireui-wrapper::element
        :attributes="$attrs->except(['wire:key', 'x-data', 'class'])"
        type="password"
        x-bind:type="type"
    />

    <x-slot name="append">
        <button
            type="button"
            x-on:click="toggle"
            tabindex="-1"
            @class([
                'outline-none text-gray-400 cursor-pointer mr-2',
                'input-focus:text-primary-600 focus:text-primary-600',
                'invalidated:text-negative-600 invalidated:focus:text-negative-600',
            ])
        >
            <x-dynamic-component
                x-show="!status"
                :component="WireUi::component('icon')"
                name="eye-slash"
                class="w-5 h-5"
            />

            <x-dynamic-component
                x-show="status"
                :component="WireUi::component('icon')"
                name="eye"
                class="w-5 h-5"
                x-cloak
            />
        </button>
    </x-slot>
</x-dynamic-component>
