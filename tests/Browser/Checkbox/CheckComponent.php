<?php

namespace Tests\Browser\Checkbox;

class CheckComponent extends \Livewire\Component
{
    public $checkbox = false;

    public $errorless = null;

    protected array $rules = [
        'checkbox' => 'accepted',
        'errorless' => 'required',
    ];

    protected array $messages = [
        'checkbox.accepted' => 'accept it',
        'errorless.required' => 'input is required',
    ];

    public function render(): string
    {
        return <<<BLADE
        <div>
            <h1>Checkbox Test</h1>

            <span dusk="checkbox">@json(\$checkbox)</span>

            // test it_should_render_with_label_and_change_value
            <x-checkbox label="Remember me" wire:model.live="checkbox" />

            // test it_should_dont_see_the_input_error_message
            <x-checkbox label="Test error less" wire:model.live="errorless" :errorless="true" />

            <button wire:click="validateCheckbox" dusk="validate">validate</button>
        </div>
        BLADE;
    }

    public function validateCheckbox(): void
    {
        $this->validate();
    }
}
