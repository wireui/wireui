<?php

namespace Tests\Browser\Badge;

class BadgeComponent extends \Livewire\Component
{
    public function render(): string
    {
        return <<<BLADE
        <div>
            <h1>Badge test</h1>

            <x-badge name="Info"/>
            <x-badge info name="Info"/>
            <x-badge info close name="Info"/>
            <x-badge info square name="Info"/>
            <x-badge info close square name="Info"/>
            <x-badge info icon name="Info">
                <x-icon name="check" class="w-3.5 h-3.5"/>
            </x-badge>

            <x-badge name="Warning"/>
            <x-badge warning name="Warning"/>
            <x-badge warning close name="Warning"/>
            <x-badge warning square name="Warning"/>
            <x-badge warning close square name="Warning"/>
            <x-badge warning icon name="Warning">
                <x-icon name="check" class="w-3.5 h-3.5"/>
            </x-badge>

            <x-badge name="Success"/>
            <x-badge success name="Success"/>
            <x-badge success close name="Success"/>
            <x-badge success square name="Success"/>
            <x-badge success close square name="Success"/>
            <x-badge success icon name="Success">
                <x-icon name="check" class="w-3.5 h-3.5"/>
            </x-badge>

            <x-badge name="Danger"/>
            <x-badge danger name="Danger"/>
            <x-badge danger close name="Danger"/>
            <x-badge danger square name="Danger"/>
            <x-badge danger close square name="Danger"/>
            <x-badge danger icon name="Danger">
                <x-icon name="check" class="w-3.5 h-3.5"/>
            </x-badge>
        </div>
        BLADE;
    }
}
