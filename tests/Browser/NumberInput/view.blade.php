<div>
    <h1>Number Input test</h1>

    // test it_should_see_label_and_corner_hint
    <x-inputs.number label="Input 1" corner-hint="Corner 1" />

    // test it_should_see_hint_and_not_see_prefix_and_suffix
    <x-inputs.number
        label="Input 1"
        corner-hint="Corner 1"
        hint="Hint 1"
        prefix="Prefix 1"
        suffix="Suffix 1"
    />

    // test it_should_not_see_prepend_and_append_slots
    <x-inputs.number>
        <x-slot name="prepend">
            <a>prepend</a>
        </x-slot>

        <x-slot name="append">
            <a>append</a>
        </x-slot>
    </x-inputs.number>

    // test it_should_not_see_prefix_suffix_append_and_prepend
    <x-inputs.number prefix="prefix 2" suffix="suffix 2">
        <x-slot name="prepend">
            <a>prepend 2</a>
        </x-slot>

        <x-slot name="append">
            <a>append 2</a>
        </x-slot>
    </x-inputs.number>

    // test it_should_set_model_value_to_livewire
    <x-inputs.number dusk="input" wire:model="number" label="Model Input" />
    <span dusk="number-value">{{ $number }}</span>

    // test it_should_change_the_input_value_when_clicking_on_the_plus_or_minus_icon
    <x-inputs.number wire:key="show-number" name="show-number" label="Show Number" />
</div>
