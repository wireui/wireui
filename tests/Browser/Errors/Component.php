<?php

namespace Tests\Browser\Errors;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public array $only = [];

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    public function addErrors(): void
    {
        $this->addError('first', 'first error');
        $this->addError('second', 'second error');
        $this->addError('third', 'third error');
    }

    public function addFilterErrors(): void
    {
        $this->only = ['first', 'second'];
        $this->addErrors();
    }
}
