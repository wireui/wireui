<?php

namespace Tests\Browser\Input;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $model = null;

    protected array $rules = ['model' => 'required'];

    protected array $messages = ['model.required' => 'input cant be empty'];

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
