<?php

namespace Tests\Browser\ConfirmDirective;

use Illuminate\Support\Facades\View;

class Component extends \Livewire\Component
{
    public string $value = '';

    public function render()
    {
        return View::file(__DIR__ . '/view.blade.php');
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
