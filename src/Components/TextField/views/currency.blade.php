<x-dynamic-component
    :component="WireUi::component('text-field')"
    :data="$wrapperData"
    :attributes="$attrs->only(['wire:key', 'class'])"
    x-data="wireui_inputs_currency"
    :x-props="WireUi::toJs([
        'emitFormatted' => $emitFormatted,
        'thousands'     => $thousands,
        'decimal'       => $decimal,
        'precision'     => $precision,
        'wireModel'     => WireUi::wireModel(isset($__livewire) ? $this : null, $attributes),
        'alpineModel'   => WireUi::alpineModel($attributes),
    ])"
>
    @include('wireui-wrapper::components.slots')

    <div class="hidden">
        <x-wireui-wrapper::element
            x-bind:value="value"
            x-ref="rawInput"
            :name="$name"
            :value="$value"
        />
    </div>

    <x-wireui-wrapper::element
        x-model="input"
        x-ref="input"
        x-on:blur="onBlur"
        :attributes="$attrs->whereStartsWith(['placeholder', 'dusk', 'cy', 'readonly', 'disabled'])"
    />
</x-dynamic-component>
