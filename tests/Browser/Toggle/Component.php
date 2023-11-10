<?php

namespace Tests\Browser\Toggle;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $toggle = false;

    public $errorless = null;

    protected array $rules = [
        'toggle' => 'accepted',
        'errorless' => 'required',
    ];

    protected array $messages = [
        'toggle.accepted' => 'accept it',
        'errorless.required' => 'input is required',
    ];

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    public function validateToggle(): void
    {
        $this->validate();
    }
}
