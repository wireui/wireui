<?php

namespace Tests\Browser\ColorPicker;

class LazyComponent extends \Livewire\Component
{
    public ?string $color = '#00000';

    public function render()
    {
        return <<<HTML
        <div>
            <span dusk="model">{{ \$color }}</span>
            <x-color-picker wire:model.lazy="color" />
        </div>
        HTML;
    }
}
