<div>
    <h1>Input test</h1>

    // test it_should_see_label_and_corner_hint
    <x-input label="Input 1" corner-hint="Corner 1" />

    <x-input
        label="Input 1"
        corner-hint="Corner 1"
        hint="Hint 1"
        prefix="Prefix 1"
        suffix="Suffix 1"
    />

    // test it_should_see_hint_prefix_and_suffix
    <x-input>
        <x-slot name="prepend">
            <a>prepend</a>
        </x-slot>

        <x-slot name="append">
            <a>append</a>
        </x-slot>
    </x-input>

    // test it_should_see_append_and_prepend_slots
    <x-input prefix="prefix 2" suffix="suffix 2">
        <x-slot name="prepend">
            <a>prepend 2</a>
        </x-slot>

        <x-slot name="append">
            <a>append 2</a>
        </x-slot>
    </x-input>

    // test it_should_see_prefix_and_suffix_instead_append_or_prepend_slots
    // test it_should_set_model_value_to_livewire
    <x-input dusk="input" wire:model="model" label="Model Input" />
    <span dusk="model-value">{{ $model }}</span>

    // test it_should_dont_see_the_input_error_message
    <x-input wire:model="errorless" label="Test error less" :errorless="true" />
</div>
