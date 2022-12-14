<div>
    <span dusk="model">{{ $color }}</span>

    <x-color-picker wire:model.debounce.500ms="color" />
</div>
