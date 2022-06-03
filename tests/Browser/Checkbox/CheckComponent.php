<?php

namespace Tests\Browser\Checkbox;

class CheckComponent extends \Livewire\Component
{
    public $checkbox = false;

    protected array $rules = ['checkbox' => 'accepted'];

    protected array $messages = ['checkbox.accepted' => 'accept it'];

    public function render(): string
    {
        return <<<BLADE
        <div>
            <h1>Checkbox Test</h1>

            <span dusk="checkbox">@json(\$checkbox)</span>

            // test it_should_render_with_label_and_change_value
            <x-checkbox label="Remember me" wire:model="checkbox" />

            <button wire:click="validateCheckbox" dusk="validate">validate</button>
        </div>
        BLADE;
    }

    public function validateCheckbox(): void
    {
        $this->validate();
    }
}
