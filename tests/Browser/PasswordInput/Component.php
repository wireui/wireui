<?php

namespace Tests\Browser\PasswordInput;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $password = null;

    protected array $rules = [
        'password' => 'required',
    ];

    protected array $messages = [
        'password.required' => 'input cant be empty',
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
