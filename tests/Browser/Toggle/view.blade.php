<div>
    <h1>Input test</h1>

    <span dusk="toggle">@json($toggle)</span>

    // test it_should_render_label_and_change_value
    <x-toggle label="Active Notifications" wire:model="toggle" />

    <button wire:click="validateToggle" dusk="validate">validate</button>
</div>
