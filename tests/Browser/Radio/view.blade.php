<div>
    <h1>Radio Test</h1>

    <span dusk="radio">@json($radio)</span>

    // test it_should_render_with_label_and_change_value
    <x-radio id="laravel"  value="Laravel"  label="Laravel"  wire:model="radio" />
    <x-radio id="livewire" value="Livewire" label="Livewire" wire:model="radio" />

    <button wire:click="validateRadio" dusk="validate">validate</button>
</div>
