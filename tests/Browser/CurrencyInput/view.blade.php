<div>
    <h1>Currency Input test</h1>

    // test it_should_mask_currency_value
    // test it_should_follow_livewire_model_changes
    <x-inputs.currency label="Currency" wire:model="currency" />
    <button dusk="button.change.currency" wire:click="changeCurrency">
        change
    </button>

    // test it_should_type_currency_value_and_emit_formatted_value
    <x-inputs.currency label="Formatted Currency" emit-formatted wire:model="formattedCurrency" />
    <span dusk="formattedCurrency">{{ $formattedCurrency }}</span>

    // test it_should_parse_custom_currencies_like_brazilian_real
    <x-inputs.currency
        thousands="."
        decimal=","
        precision="2"
        wire:model="brazilCurrency"
    />
</div>
