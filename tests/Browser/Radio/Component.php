<?php

namespace Tests\Browser\Radio;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public $radio = null;

    protected array $rules = ['radio' => 'required'];

    protected array $messages = ['radio.required' => 'select one'];

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    public function validateRadio(): void
    {
        $this->validate();
    }
}
