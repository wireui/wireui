<x-dynamic-component
    :component="WireUi::component('text-field')"
    :config="$config"
    :attributes="$wrapper"
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

    <div class="hidden" hidden>
        <x-wireui-wrapper::hidden
            :id="$id"
            :name="$name"
            :value="$value"
            x-ref="rawInput"
            x-bind:value="value"
        />
    </div>

    <x-wireui-wrapper::element
        x-ref="input"
        x-model="input"
        x-on:blur="onBlur"
        :attributes="$input"
    />
</x-dynamic-component>
