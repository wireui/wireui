<x-text-field
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'x-data', 'class'])"
    x-data="wireui_inputs_maskable"
    :x-props="WireUi::toJs([
        'emitFormatted' => $emitFormatted,
        'mask'          => $mask,
        'wireModel'     => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
        'alpineModel'   => WireUi::alpineModel($attributes),
    ])"
>
    @include('wireui-wrapper::components.slots')

    <div class="hidden">
        <x-wireui-wrapper::element x-bind:value="value" :name="$name" />
    </div>

    <x-wireui-wrapper::element
        x-model="input"
        x-ref="input"
        x-on:blur="onBlur"
        :attributes="$attrs->whereStartsWith(['placeholder', 'dusk', 'cy', 'readonly', 'disabled'])"
    />
</x-text-field>
