<?php

namespace Tests\Browser\Toggle;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $toggle = false;

    protected array $rules = ['toggle' => 'accepted'];

    protected array $messages = ['toggle.accepted' => 'accept it'];

    public function validateToggle(): void
    {
        $this->validate();
    }

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }
}
