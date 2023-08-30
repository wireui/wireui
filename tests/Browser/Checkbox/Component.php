<?php

namespace Tests\Browser\Checkbox;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $checkbox = false;

    protected array $rules = ['checkbox' => 'accepted'];

    protected array $messages = ['checkbox.accepted' => 'accept it'];

    public function validateCheckbox(): void
    {
        $this->validate();
    }

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}
