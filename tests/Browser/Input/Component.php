<?php

namespace Tests\Browser\Input;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $model = null;

    public $errorless = null;

    protected array $rules = [
        'model'     => 'required',
        'errorless' => 'required',
    ];

    protected array $messages = [
        'model.required'     => 'input cant be empty',
        'errorless.required' => 'input is required'
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
