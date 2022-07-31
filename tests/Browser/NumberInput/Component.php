<?php

namespace Tests\Browser\NumberInput;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public mixed $number = null;

    protected array $rules = [
        'number' => 'required|integer|between:5,10',
    ];

    protected array $messages = [
        'number.required' => 'input cant be empty',
        'number.integer'  => 'input must be an integer',
        'number.between'  => 'input must be within the specified range',
    ];

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    public function validateInput(): void
    {
        $this->validate();
    }

    public function resetInputValidation(): void
    {
        $this->resetValidation();
    }
}
